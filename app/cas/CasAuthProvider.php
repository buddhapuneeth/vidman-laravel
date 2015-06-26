<?php namespace cas;
 
use Illuminate\Auth\GenericUser;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;
 
class CasAuthProvider implements UserProviderInterface
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $id
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveById($id)
    {
        return $this->casUser();
    }
 
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        return $this->casUser();
    }
 
    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials)
    {
        return true;
    }
 
    protected function casUser()
    {
        $cas_host = \Config::get('app.cas_host');
        $cas_context = \Config::get('app.cas_context');
        $cas_port = \Config::get('app.cas_port');
        \phpCAS::setDebug();
        \phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
        \phpCAS::setNoCasServerValidation();
 
        if (\phpCAS::isAuthenticated())
        {
            $attributes = array(
                'id' => \phpCAS::getUser(),
                'name' => \phpCAS::getUser()
            );
            return new GenericUser($attributes);
        }
        else
        {
            \phpCAS::setServerURL(\Config::get('app.url'));
            \phpCAS::forceAuthentication();
        }
        return null;
    }
 
    /**
     * Needed by Laravel 4.1.26 and above
     */
    public function retrieveByToken($identifier, $token)
    {
        return new \Exception('not implemented');
    }
 
    /**
     * Needed by Laravel 4.1.26 and above
     */
    public function updateRememberToken(UserInterface $user, $token)
    {
        return new \Exception('not implemented');
    }
}
?>
