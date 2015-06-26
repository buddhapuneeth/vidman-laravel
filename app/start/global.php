Auth::extend('cas', function($app)
{
    return new cas\CasAuthProvider;
});
