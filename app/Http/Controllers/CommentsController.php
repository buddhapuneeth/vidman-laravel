<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Xavrsl\Cas\Facades\Cas;
use App\Helpers\AuthHelper;
use App\Comment;
use App\Http\Requests;
use Input;
use Redirect;
use App\Video;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
class CommentsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request)
    {
        Log::info("in comment store");
        $input = array_filter($request->all(),'strlen');
        Log::info($input['comment']);
        Log::info($input['slug']);
        #Log::info( $request->session()->get('slag'));
        #$request->session()->forget('slag');
        $comment_req = array(
          'comment' => $input['comment'],
          'student' => $input['student'],
          'class' =>$input['class'],
          'instructor' => $input['instructor'],
          'slug' => $input['slug'],
          'show_status'=>"False"
        );
        $newComment = new Comment($comment_req);
        $newComment->save();
        #$videos = Video::where('slug','like', $input['slug'])->get();
        return Redirect::route('videos.show', $input['slug'])->with('message', 'Comment uploaded, Instructor review in progress');
    }
    public function addReply(Request $request)
    {
        Log::info("in reply store");
        $input = array_filter($request->all(),'strlen');
        Log::info($input['com']);
        Log::info($input['parent']);
        #Log::info( $request->session()->get('slag'));
        #$request->session()->forget('slag');
        $com = Comment::where('id','like',$input['parent'])->first();
        Log::info("raw");
        Log::info($com);
        Log::info($com->class);

        $comment_req = array(
          'comment' => $input['com'],
          'student' => $input['student'],
          'class' =>$com['class'],
          'instructor' => $com['instructor'],
          'slug' => $com['slug'],
          'parent' => $com['id'],
          'par_com'=>$com['comment'],
          'par_user'=>$com['student'],
          'show_status'=>"False"
        );
        $newComment = new Comment($comment_req);
        $newComment->save();
        #$videos = Video::where('slug','like', $input['slug'])->get();
        return Redirect::route('videos.show', $com['slug'])->with('message', 'Reply uploaded, Instructor review in progress');
    }
    public function editComment(Request $request)
    {
      $selections = array('posts_all'=>1,'posts_comments'=>0,'posts_replies'=>0,'status_all'=>1,'status_visible'=>0,'status_hide'=>0,'status_spam'=>0 ,'end' => \Carbon\Carbon::now(), 'start' =>  \Carbon\Carbon::now()->subWeek());
      $input = array_filter($request->all(),'strlen');
      $item_slug = $input['slug'];
      Log::info("slug is".$input['slug']);
      $comments = Comment::where('slug','like',$input['slug'])->orderBy('show_status', 'ASC')->paginate(15);
      return view('videos.comments',compact('comments','selections','item_slug'));
    }
    public function editCommentStatus(Request $request)
    {
      $item_slug = $request->input('item_slug');
      $input = array_filter($request->all(),'strlen');
      $posts_all = $input['posts_all'];
      Log::info("id in editStatus is ".$input['id1']);
      Log::info("selection in return".$input['change_status']);
      $selections = array('posts_all'=>$input['posts_all'],'posts_comments'=>$input['posts_comments'],'posts_replies'=>$input['posts_replies'],'status_all'=>$input['status_all'],'status_visible'=>$input['status_visible'],'status_hide'=>$input['status_hide'],'status_spam'=>$input['status_spam'],'start'=>$input['start'],'end'=>$input['end']);
      if($input['change_status']=="visible"){
          $returnval = Comment::where('id','like',$input['id1'])->update(['show_status'=> 1]);
      }
      elseif($input['change_status']=="hide"){
          $returnval = Comment::where('id','like',$input['id1'])->update(['show_status'=> 0]);
      }
      else{
          $returnval = Comment::where('id','like',$input['id1'])->update(['show_status'=> -1]);
      }
      $status = 2;
      if($input['status_visible']=='1'){
      $status = 1;
      }elseif($input['status_hide']=='1'){
      $status = 0;
      }elseif($input['status_hide']=='1'){
      $status = -1;
      }
      // if(array_key_exists("slug", $input)){
      //     $comments = Comment::where('slug','like',$input['slug'])->orderBy('show_status', 'ASC')->paginate(15);
      // }else{
      //   $comments = Comment::orderBy('show_status', 'ASC')->paginate(15);
      // }
      return $this->common_filter($selections,$item_slug,$status);
      //return $this->dummy($comments, $selections);
      //return view('videos.comments',compact('comments','selections'));
    }

    public function showReplies(Request $request){
      $input = array_filter($request->all(),'strlen');
      Log::info("comment id in show replies is ".$input['parent']);
      $comments = Comment::where('parent','like',$input['parent'])->get();
      // $parent1 = Comment::where('id','like',$input['parent'])->get();
      // Log::info("parent details:".$parent1);
      $parent = $input['parent'];
      return view('videos.replies' , compact('comments','parent'));
    }
    public function showComments(Request $request){
      $selections = array('posts_all'=>1,'posts_comments'=>0,'posts_replies'=>0,'status_all'=>1,'status_visible'=>0,'status_hide'=>0,'status_spam'=>0, 'end' => \Carbon\Carbon::now(), 'start' =>  \Carbon\Carbon::now()->subWeek());
      $comments = Comment::orderBy('show_status', 'ASC')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
      $item_slug = "-1"; //inferring view that call is at global level, not at particular video level
      $classes = Video::distinct()->groupBy('class')->get();
      return view('videos.comments',compact('comments','selections','item_slug','classes'));
    }
    public function filter(Request $request){
      Log::info(" Inside filter, request received");
      Log::info("dates:".$request['start']);
      Log::info("dates:".$request['end']);
      Log::info(" Inside filter, slug received is ".$request->input('item_slug'));
      $item_slug = $request->input('item_slug');
      $posts = $request->input('posts');
      $status = $request->input('status');
      $selections = array('posts_all'=>0,'posts_comments'=>0,'posts_replies'=>0,'status_all'=>0,'status_visible'=>0,'status_hide'=>0,'status_spam'=>0,'start' => $request['start'], 'end' => $request['end']);
      if($status== 2){
          $selections['status_all']= 1;
      }elseif($status== 1){
          $selections['status_visible']= 1;
      }elseif($status == 0){
          $selections['status_hide']= 1;
      }else{
          $selections['status_spam']= 1;
      }
      if($posts=="all"){
          $selections['posts_all'] = 1;
      }elseif ($posts=="comments") {
          $selections['posts_comments'] = 1;
      }elseif($posts=="replies"){
          $selections['posts_replies'] = 1;
      }
      return $this->common_filter($selections,$item_slug,$status);
    }
    public function common_filter($selections,$item_slug,$status){
      Log::info("inside common filter");
      Log::info("inside common filter, item_slug is ".$item_slug);
      Log::info("inside common filter, dates:".$selections['start']);
      Log::info("inside common filter, dates:".$selections['end']);
      if($selections['posts_all'] == 1){
        Log::info("all comments");
        if($status== 2){
           Log::info("in status 2 allcomments");
            if($item_slug=="-1"){
              $comments = Comment::orderBy('show_status', 'ASC')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }else{
              $comments = Comment::orderBy('show_status', 'ASC')->whereBetween('updated_at',[$selections['start'],$selections['end']])->where('slug','like',$item_slug)->paginate(15);
            }
        }else {
            if($item_slug=="-1"){
              $comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
              //->whereBetween('updated_at',['2017-02-22','2017-03-28'])
            }else{
              $comments = Comment::orderBy('show_status', 'ASC')->where('slug','like',$item_slug)->where('show_status','like',$status)->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }
              //$comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->paginate(15);
        }
      }
      elseif ($selections['posts_comments'] == 1) {
          Log::info("only comments");
          if($status == 2){
            if($item_slug=="-1"){
              $comments = Comment::orderBy('show_status', 'ASC')->whereNull('parent')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }else{
              $comments = Comment::orderBy('show_status', 'ASC')->where('slug','like',$item_slug)->whereNull('parent')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }
              //$comments = Comment::orderBy('show_status', 'ASC')->whereNull('parent')->paginate(15);
          }else {
            if($item_slug=="-1"){
              $comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->whereNull('parent')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }else{
              $comments = Comment::orderBy('show_status', 'ASC')->where('slug','like',$item_slug)->where('show_status','like',$status)->whereNull('parent')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }
                //$comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->whereNull('parent')->paginate(15);
          }
      }elseif($selections['posts_replies'] == 1){
          Log::info("only replies");
          if($status == 2){
            if($item_slug=="-1"){
              $comments = Comment::orderBy('show_status', 'ASC')->whereNotNull('parent')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }else{
              $comments = Comment::orderBy('show_status', 'ASC')->where('slug','like',$item_slug)->whereNotNull('parent')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }
              //$comments = Comment::orderBy('show_status', 'ASC')->whereNotNull('parent')->paginate(15);
          }else {
            if($item_slug=="-1"){
              $comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->whereNotNull('parent')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }else{
              $comments = Comment::orderBy('show_status', 'ASC')->where('slug','like',$item_slug)->where('show_status','like',$status)->whereNotNull('parent')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
            }
                //$comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->whereNotNull('parent')->paginate(15);
          }
      }else{
          Log::info("no selection");
          $comments = Comment::orderBy('show_status', 'ASC')->whereBetween('updated_at',[$selections['start'],$selections['end']])->paginate(15);
      }
      return view('videos.comments',compact('comments','selections','item_slug'));
    }
    public function filter1(Request $request){
      //$input = array_filter($request->all(),'strlen');
      Log::info(" in filter ".$request);
      Log::info("slug:".$request['slug']);
      $posts = $request->input('posts');
      $status = $request->input('status');
      Log::info("status".$status);
      Log::info("posts".$posts);
      $selections = array('posts_all'=>0,'posts_comments'=>0,'posts_replies'=>0,'status_all'=>0,'status_visible'=>0,'status_hide'=>0,'status_spam'=>0);
      if($status== 2){
          $selections['status_all']= 1;
      }elseif($status== 1){
          $selections['status_visible']= 1;
      }elseif($status == 0){
          $selections['status_hide']= 1;
      }else{
          $selections['status_spam']= 1;
      }

      Log::info(" in filter, body parsing: ".$posts." ".$status);
      if($posts=="all"){
        Log::info("all comments");
        $selections['posts_all'] = 1;
        if($status== 2){
            $comments = Comment::orderBy('show_status', 'ASC')->paginate(15);
        }else {
              $comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->paginate(15);
        }
      }
      elseif ($posts=="comments") {
          Log::info("only comments");
          $selections['posts_comments'] = 1;
          if($status== 2){
              $comments = Comment::orderBy('show_status', 'ASC')->whereNull('parent')->paginate(15);
          }else {
                $comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->whereNull('parent')->paginate(15);
          }
      }elseif($posts=="replies"){
          Log::info("only replies");
            $selections['posts_replies'] = 1;
          if($status== 2){
              $comments = Comment::orderBy('show_status', 'ASC')->whereNotNull('parent')->paginate(15);
          }else {
                $comments = Comment::orderBy('show_status', 'ASC')->where('show_status','like',$status)->whereNotNull('parent')->paginate(15);
          }
      }else{
          Log::info("no selection");
          $comments = Comment::orderBy('show_status', 'ASC')->paginate(15);
      }
      $classes = Comment::orderBy('show_status', 'ASC')->paginate(15);
      // Comment::distinct()->groupBy('class')->get();
      return view('videos.comments',compact('comments','classes','selections','item_slug'));
    }
}
