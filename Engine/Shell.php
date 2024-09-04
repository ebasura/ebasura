<?php
use phpseclib3\Net\SSH2;
use phpseclib3\Exception\UnableToConnectException;

/**
 * Shell PHP Script
 */
class Shell
{
    private SSH2 $ssh;

    public function __construct($host, $username, $password, $port = 22)
    {
        $this->ssh = new SSH2($host, $port);

        if (!$this->ssh->login($username, $password)) {
            throw new UnableToConnectException('Login Failed');
        }
    }

    /**
     * @param $command Command
     * @return bool|string
     * @throws Exception
     */
    public function exec($command)
    {
        $output = $this->ssh->exec($command);
        if ($output === false) {
            throw new Exception('Command execution failed');
        }
        return $output;
    }
}

