<?php

namespace App\Services\ConfigServices;

class Git
{
    private  $gitUser;
    private  $gitToken;
    private  $gitEmail;

    public function __construct()
    {
        $this->gitUser= getenv('USERGIT', false);
        $this->gitToken = getenv('TOKENGIT', false);
        $this->gitEmail = getenv('EMAILGIT', false);
        shell_exec('git config --global user.name "'.$this->gitUser.'"');
        shell_exec('git config --global user.email "'.$this->gitEmail.'"');
    }

    public function getGitUser()
    {
        return $this->gitUser;
    }

    public function getGitToken()
    {
        return $this->gitToken;
    }

    public function getGitEmail()
    {
        return $this->gitEmail;
    }

}
