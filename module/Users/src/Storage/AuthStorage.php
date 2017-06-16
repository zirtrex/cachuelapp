<?php

namespace Users\Storage;

use Zend\Authentication\Storage\Session;
use Zend\Authentication\Storage\StorageInterface;


class AuthStorage implements StorageInterface
{	
    const NAME = 'session';
    
    private $storage;
    private $resolvedIdentity;
	
	public function isEmpty()
	{
	    if ($this->getStorage()->isEmpty()) {
	        return true;
	    }
	    $identity = $this->getStorage()->read();
	    if ($identity === null) {
	        $this->clear();
	        return true;
	    }
	    return false;
	}
	
	public function read()
	{
	    if ($this->resolvedIdentity !== null) {
	        return $this->resolvedIdentity;
	    }
	    $identity = $this->getStorage()->read();
	    if ($identity) {
	        $this->resolvedIdentity = $identity;
	    } else {
	        $this->resolvedIdentity = null;
	    }
	    return $this->resolvedIdentity;
	}
	
	public function write($contents)
	{
	    /**
	     * when $this->authService->authenticate(); is valid, the session
	     * automatically called write('username')
	     * in this case, i want to save data like
	     * ["storage"] => array(4) {
	     * ["id"] => string(1) "1"
	     * ["username"] => string(5) "admin"
	     * ["ip_address"] => string(9) "127.0.0.1"
	     * ["user_agent"] => string(81) "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7;
	     * rv:18.0)
	     * Gecko/20100101 Firefox/18.0"
	     * }
	     */
	    $this->resolvedIdentity = null;
	    $this->getStorage()->write($contents);
	}
	
    public function clear()
    {
        $this->resolvedIdentity = null;
        $this->getStorage()->clear();
    }
    
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
        return $this;
    }
    
    public function getStorage()
    {
        if ($this->storage === null) {
            $this->setStorage(new Session(self::NAME));
        }
        return $this->storage;
    }
}









