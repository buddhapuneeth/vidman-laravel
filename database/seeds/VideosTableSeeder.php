<?php
 
use Illuminate\Database\Seeder;
 
class VideosTableSeeder extends Seeder {
 
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('videos')->delete();
 
        $videos = array(
            ['id' => 1, 'vid_name' => 'video_1', 'slug'=>'video-1', 'topic' => 'Algebra Ex1','class'=>'MAT267','instructor'=>'Scott','vid_url'=>'videos/video_1', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'First Video', 'tags'=>'search1, first, check, whateveri'], 
            ['id' => 2, 'vid_name' => 'video_2', 'slug'=>'video-2', 'topic' => 'Limits','class'=>'MAT265','instructor'=>'Heckman','vid_url'=>'videos/video_2', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'Sec Video', 'tags'=>'search1, sec, check, whatever'],  
            ['id' => 3, 'vid_name' => 'video_3', 'slug'=>'video-3', 'topic' => 'Derivatives','class'=>'MAT267','instructor'=>'Scott','vid_url'=>'videos/video_3', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'Third Video', 'tags'=>'search1, third, check, whatever'], 
            ['id' => 4, 'vid_name' => 'video_4', 'slug'=>'video-4', 'topic' => 'Algebra','class'=>'MAT267','instructor'=>'Scott','vid_url'=>'videos/video_4', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'fourth Video', 'tags'=>'search2, fourth, check, whatever'], 
            ['id' => 5, 'vid_name' => 'video_5', 'slug'=>'video-5', 'topic' => 'Integrals','class'=>'MAT265','instructor'=>'Heckman','vid_url'=>'videos/video_5', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'Fifth Video', 'tags'=>'search2, fifth, uncheck, whatever'], 
            ['id' => 6, 'vid_name' => 'video_6', 'slug'=>'video-6', 'topic' => 'Geometry','class'=>'MAT267','instructor'=>'Scott','vid_url'=>'videos/video_6', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'Sixth Video', 'tags'=>'search2, six, check, whatever'], 
            ['id' => 7, 'vid_name' => 'video_7', 'slug'=>'video-7', 'topic' => 'Geometry','class'=>'MAT267','instructor'=>'Scott','vid_url'=>'videos/video_7', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'Seven Video', 'tags'=>'search3, seven, uncheck, whatever'], 
            ['id' => 8, 'vid_name' => 'video_8', 'slug'=>'video-8', 'topic' => 'Probability','class'=>'MAT265','instructor'=>'Heckman','vid_url'=>'videos/video_8', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'Eight Video', 'tags'=>'search3, eight, uncheck, whatever'], 
            ['id' => 9, 'vid_name' => 'video_9', 'slug'=>'video-9', 'topic' => 'Combinations','class'=>'MAT267','instructor'=>'Scott','vid_url'=>'videos/video_9', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'Nineth Video', 'tags'=>'search3, nine,uncheck, whatever'], 
            ['id' => 10,'vid_name' => 'video_10', 'slug'=>'video-10', 'topic' => 'Permutations','class'=>'MAT267','instructor'=>'Scott','vid_url'=>'videos/video_10', 'created_on' => new DateTime, 'created_by'=>'ravi', 'title'=>'Tenth Video', 'tags'=>'search3, ten, check, nevermind'], 
        );
 
        // Uncomment the below to run the seeder
        DB::table('videos')->insert($videos);
    }
 
}
 
?>
