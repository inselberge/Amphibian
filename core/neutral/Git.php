<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 5/2/13
 * Time: 12:51 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."GitInterface.php";
/**
 * Class Git
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Git
 */
class Git
    implements GitInterface
{
    /**
     * @var string gitPath a string storing the location of git
     */
    protected $gitPath;
    /**
     * @var string username a string storing the Git user name
     */
    protected $username;
    /**
     * @var string date a string with the date
     */
    protected $date;
    /**
     * @var bool health true = clean; false = dirty
     */
    protected $health;
    /**
     * @var string repositoryName a string storing the repository name
     */
    protected $repositoryName;
    /**
     * @var string remoteURL holds a remote URL for cloning or adding a remote
     */
    protected $remoteURL;
    /**
     * @var array remoteHosts the list of remote hosts
     */
    protected $remoteHosts = array();
    /**
     * @var string branchName a string storing the branch name
     */
    protected $branchName;
    /**
     * @var string tagName a string storing the tag name
     */
    protected $tagName;
    /**
     * @var array output an array containing the output of an exec
     */
    protected $output;
    /**
     * @var integer status an integer denoting the return status
     */
    protected $status;
    /**
     * @var object Git a singleton instance of this class
     */
    static public $Git;

    /** __construct
     *
     */
    protected function __construct()
    {
        $this->prep();
    }

    /** instance
     *
     * @return Git
     */
    static public function instance()
    {
        if ( !isset(self::$Git) ) {
            self::$Git = new Git();
        }
        return self::$Git;
    }

    /** factory
     *
     * @return Git
     */
    static public function factory()
    {
        return self::$Git = new Git();
    }
    /** prep
     *
     * @return bool
     */
    protected function prep()
    {
        try {
            if ( $this->checkGit() ) {
                if ( !$this->buildBranchName() ) {
                    throw new ExceptionHandler(__METHOD__.": branch invalid");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": Git is not installed!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setBranchName
     *
     * @param string $branchName a valid branch name
     *
     * @return boolean
     */
    public function setBranchName( $branchName )
    {
        try {
            if ( CheckInput::checkNewInput($branchName) ) {
                $this->branchName = $branchName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": branchName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getBranchName
     *
     * @return string
     */
    public function getBranchName()
    {
        return $this->branchName;
    }

    /**  setRemoteHosts
     *
     * @param array $remoteHosts an array of remote hosts
     *
     * @return boolean
     */
    public function setRemoteHosts( $remoteHosts )
    {
        try {
            if ( CheckInput::checkNewInputArray($remoteHosts) ) {
                $this->remoteHosts = $remoteHosts;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": remoteHosts is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRemoteHosts
     *
     * @return array
     */
    public function getRemoteHosts()
    {
        return $this->remoteHosts;
    }

    /**  setRemoteURL
     *
     * @param string $remoteURL
     *
     * @return boolean
     */
    public function setRemoteURL( $remoteURL )
    {
        try {
            if ( CheckInput::checkNewInput($remoteURL) ) {
                $this->remoteURL = $remoteURL;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": remoteURL is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRemoteURL
     *
     * @return string
     */
    public function getRemoteURL()
    {
        return $this->remoteURL;
    }

    /**  setRepositoryName
     *
     * @param string $repositoryName a valid repository
     *
     * @return boolean
     */
    public function setRepositoryName( $repositoryName )
    {
        try {
            if ( CheckInput::checkNewInput($repositoryName) ) {
                $this->repositoryName = $repositoryName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": repositoryName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRepositoryName
     *
     * @return string
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**  setTagName
     *
     * @param string $tagName a valid tag to use
     *
     * @return boolean
     */
    public function setTagName( $tagName )
    {
        try {
            if ( CheckInput::checkNewInput($tagName) ) {
                $this->tagName = $tagName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": tagName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTagName
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**  setUsername
     *
     * @param string $username a valid username
     *
     * @return boolean
     */
    public function setUsername( $username )
    {
        try {
            if ( CheckInput::checkNewInput($username) ) {
                $this->username = $username;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": username is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getUsername
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /** prepExec
     *
     * @return void
     */
    protected function prepExec()
    {
        $this->output = array();
        $this->status = null;
    }

    /** checkGit
     *
     * @return bool
     */
    protected function checkGit()
    {
        $this->gitPath = exec("which git");
        if ( $this->check($this->gitPath) ) {
            return true;
        } else {
            return false;
        }
    }

    /** check
     *
     * @param mixed $var the variable to check
     *
     * @return bool
     */
    protected function check( $var )
    {
        if ( CheckInput::checkNewInput($var) ) {
            return true;
        } else {
            return false;
        }
    }

    /** initializeHealth
     *
     * @return bool
     */
    public function initializeHealth()
    {
        try {
            $this->prepExec();

            exec(
                $this->gitPath
                . " status --porcelain ",
                $this->output,
                $this->status
            );

            if ( count($this->output) == 0 ) {
                $this->health = true;
            } else {
                $this->health = false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** buildBranchName
     *
     * @return bool
     */
    protected function buildBranchName()
    {
        try {
            if ( $this->initializeUserName() ) {
                if ( $this->getDate() ) {
                    $this->branchName = $this->date . "_" . $this->username;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": Git user name invalid!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** initializeUserName
     *
     * @return bool
     */
    protected function initializeUserName()
    {
        try {
            if ( CheckInput::checkSet($this->username) ) {
            } else {
                $this->username = exec("git config --get user.name");
                if ( $this->check($this->username) ) {
                    return true;
                } else {
                    throw new ExceptionHandler(__METHOD__.": initializeUserName failed.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getDate
     *
     * @return bool|string
     */
    protected function getDate()
    {
        $this->date = date("Y-m-d_H.i.s");
        return $this->date;
    }

    /** checkoutBranch
     *
     * @return bool
     */
    public function checkoutBranch()
    {
        try {
            $this->prepExec();
            if ( CheckInput::checkNewInputArray(
                array( $this->gitPath, $this->branchName )
            )
            ) {
                exec(
                    $this->gitPath
                    . " checkout -b "
                    . $this->branchName,
                    $this->output,
                    $this->status
                );
                return $this->checkExecution();
            } else {
                throw new ExceptionHandler(__METHOD__.":Unable to checkout branch!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** add
     *
     * @param (null|string) $item the name of the file to add
     *
     * @return bool
     */
    public function add( $item = null )
    {
        try {
            $this->prepExec();
            if ( isset($item) AND !is_null($item) ) {
                exec($this->gitPath . ' add ' . $item, $this->output, $this->status);
            } else {
                exec($this->gitPath . ' add --all . ', $this->output, $this->status);
            }
            $this->checkExecution();
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** move
     *
     * @param string $source      the source location
     * @param string $destination the destination location
     *
     * @return bool
     */
    public function move( $source, $destination )
    {
        try {
            $this->prepExec();
            if ( CheckInput::checkNewInput($source) ) {
                if ( CheckInput::checkNewInput($destination) ) {
                    exec(
                        $this->gitPath . ' mv '
                        . $source . ' '
                        . $destination,
                        $this->output,
                        $this->status
                    );
                    $this->checkExecution();
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": destination path invalid");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": source path invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** remove
     *
     * @param array $array an array of files to remove
     *
     * @return bool
     */
    public function remove( $array )
    {
        try {
            if ( CheckInput::checkNewInputArray($array) ) {
                foreach ( $array as $item ) {
                    $this->rmFile($item);
                    $this->rmGit($item);
                }
                $this->rmGitBackups();
            } else {
                throw new ExceptionHandler(__METHOD__.": array invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** rmFile
     *
     * @param string $file the name of the file to remove
     *
     * @return bool
     */
    protected function rmFile( $file )
    {
        try {
            $this->prepExec();
            if ( CheckInput::checkNewInput($file) ) {
                exec("rm " . $file, $this->output, $this->status);
                $this->checkExecution();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": file invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** rmGit
     *
     * @param string $file the name of the file to remove
     *
     * @return bool
     */
    protected function rmGit( $file )
    {
        try {
            $this->prepExec();
            if ( CheckInput::checkNewInput($file) ) {
                exec($this->gitPath . ' rm ' . $file, $this->output, $this->status);
                $this->checkExecution();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": git file invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** rmGitBackups
     *
     * @return bool
     */
    protected function rmGitBackups()
    {
        $this->prepExec();
        exec($this->gitPath . ' rm  \*~', $this->output, $this->status);
        return $this->checkExecution();
    }

    /** commit
     *
     * @param string $message the message to add to the commit
     *
     * @return bool
     */
    public function commit( $message )
    {
        try {
            $this->prepExec();
            if ( CheckInput::checkNewInput($message) ) {
                exec(
                    $this->gitPath . " commit -v -m "
                    . $message,
                    $this->output,
                    $this->status
                );
                $this->checkExecution();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": message invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** tag
     *
     * @param string $tagName the name of the tag
     *
     * @return bool
     */
    public function tag( $tagName )
    {
        try {
            $this->prepExec();
            if ( CheckInput::checkNewInput($tagName) ) {
                exec(
                    $this->gitPath . " tag "
                    . $tagName,
                    $this->output,
                    $this->status
                );
                $this->checkExecution();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": tagName invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** changeBranchToMaster
     *
     * @return bool
     */
    public function changeBranchToMaster()
    {
        $this->prepExec();
        exec($this->gitPath . " checkout master", $this->output, $this->status);
        return $this->checkExecution();
    }

    /** mergeBranchWithMaster
     *
     * @return bool
     */
    public function mergeBranchWithMaster()
    {
        $this->prepExec();
        exec(
            $this->gitPath . " merge --no-ff "
            . $this->branchName,
            $this->output,
            $this->status
        );
        return $this->checkExecution();
    }

    /** deleteBranch
     *
     * @return bool
     */
    public function deleteBranch()
    {
        $this->prepExec();
        exec(
            $this->gitPath . " branch -d "
            . $this->branchName,
            $this->output,
            $this->status
        );
        return $this->checkExecution();
    }

    /** push
     *
     * @return bool
     */
    public function push()
    {
        $this->prepExec();
        exec(
            $this->gitPath . " push "
            . $this->repositoryName . " "
            . $this->branchName
            . " --tags",
            $this->output,
            $this->status
        );
        return $this->checkExecution();
    }

    /** pull
     *
     * @return bool
     */
    public function pull()
    {
        $this->prepExec();
        exec(
            $this->gitPath . " pull "
            . $this->repositoryName . " "
            . $this->branchName,
            $this->output,
            $this->status
        );
        return $this->checkExecution();
    }

    /** fetch
     *
     * @return bool
     */
    public function fetch()
    {
        try {
            if ( CheckInput::checkSet($this->repositoryName) ) {
                $this->prepExec();
                exec(
                    $this->gitPath . " fetch "
                    . $this->repositoryName,
                    $this->output,
                    $this->status
                );
            } else {
                throw new ExceptionHandler(__METHOD__ . ": repositoryName invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $this->checkExecution();
    }

    /** cloneRepository
     *
     * @return bool
     */
    public function cloneRepository()
    {
        try {
            if ( CheckInput::checkSet($this->remoteURL) ) {
                $this->prepExec();
                exec(
                    $this->gitPath . " clone "
                    . $this->remoteURL,
                    $this->output,
                    $this->status
                );
            } else {
                throw new ExceptionHandler(__METHOD__ . ": remoteURL invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $this->checkExecution();
    }

    /** initializeRemotes
     *
     * @return bool
     */
    protected function initializeRemotes()
    {
        try {
            $this->prepExec();
            exec(
                $this->gitPath . " remote show ",
                $this->output,
                $this->status
            );
            if ( CheckInput::checkSet($this->output) ) {
                $this->setRemoteHosts($this->output);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": no output!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** remote
     * @return void
     */
    public function remote()
    {
        //TODO: finish remote
    }

    /** checkExecution
     *
     * @return bool
     */
    protected function checkExecution()
    {
        try {
            if ( ! $this->checkStatus() ) {
                $this->printOutput();
                throw new ExceptionHandler(__METHOD__ . ": execution error");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkStatus
     *
     * @return bool
     */
    protected function checkStatus()
    {
        if ( $this->status == 0 ) {
            return true;
        } else {
            return false;
        }
    }

    /** printOutput
     *
     * @return void
     */
    public function printOutput()
    {
        print_r($this->output);
    }

    /** setupGit
     *
     * @return bool
     */
    public function setupGit()
    {
        try {
            /*
             * 1. check the status is OKAY
             * 2. if the status is not okay/clean, stash current status
             * 3. git checkout master
             * 4. get the list of remote hosts
             * 5. git fetch origin/remote
             * 6. git checkout -b newBranchName
             */
            if ( CheckInput::checkNewInput(BASE_URI) ) {
                chdir(BASE_URI);
                $this->initializeHealth();
                $this->forkHealth();
                $this->changeBranchToMaster();
                $this->initializeRemotes();
                if ( $this->forkRemotes() ) {
                    $this->fetch();
                    $this->checkoutBranch();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": BASE_URI undefined.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkHealth
     *
     * @return bool
     */
    protected function forkHealth()
    {
        try {
            if ( CheckInput::checkSet($this->health) ) {
                if ( !$this->health ) {
                    $this->stash();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": health not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkRemotes
     *
     * @return bool
     */
    protected function forkRemotes()
    {
        try {
            if ( CheckInput::checkSet($this->repositoryName) ) {
                if ( ! in_array($this->repositoryName, $this->remoteHosts) ) {
                    throw new ExceptionHandler(__METHOD__ . ": unknown repository.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": repository invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** tearDownGit
     *
     * @return bool
     */
    public function tearDownGit()
    {
        try {
            /*
             * 1. git add --all .
             * 2. git commit -m "some message"
             * 3. git tag "some tag"
             * 4. git fetch remoteHost --tags
             * 5. git rebase -p remoteHost/newBranchName
             * 6. git rebase -p remoteHost/master
             * 7. git push remoteHost newBranchName --tags
             * 8. git checkout master
             * 9. if the status was not okay to start, git stash pop
             */
            if ( CheckInput::checkNewInput($this->branchName) ) {
                $this->add();
                $this->commit("Amphibian file generation run by $this->username on $this->date.");
                $this->tag($this->branchName);
                $this->fetch();
                $this->rebase();
                $this->rebase("master");
                $this->push();
                $this->changeBranchToMaster();
                if (!$this->health) {
                    $this->pop();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": git not setup!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** stash
     *
     * @return bool
     */
    public function stash()
    {
        try {
            $this->prepExec();
            exec(
                $this->gitPath . " stash",
                $this->output,
                $this->status
            );
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** rebase
     *
     * @param string $branchName a valid branch name
     *
     * @return bool
     */
    public function rebase($branchName = null)
    {
        try {
            $this->prepExec();
            if ( CheckInput::checkNewInput($branchName) ) {
                exec(
                    $this->gitPath . " rebase -p "
                    . $this->repositoryName ."/". $branchName,
                    $this->output,
                    $this->status
                );
            } else {
                exec(
                    $this->gitPath . " rebase -p "
                    . $this->repositoryName ."/". $this->branchName,
                    $this->output,
                    $this->status
                );
            }
            return $this->checkExecution();

        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** pop
     *
     * @return bool
     */
    public function pop()
    {
        try {
            $this->prepExec();
            exec(
                $this->gitPath . " stash pop",
                $this->output,
                $this->status
            );
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}

/*
 * Check out a new branch before making changes
 *
$g = Git::instance();
$g->checkoutBranch();
*/
/*
 * Add the files and commit
 * $g->add();
 * $g->commit("Fixed bug 789");
 */
/*
 * Tag the commit
 * $g->tag("Bugfix.123");
 */

/*
 * Switch back to master
$g->changeBranchToMaster();
*/
/*
 * Merge branch with master
 * $g->mergeBranchWithMaster();
 */
/*
 * Delete Branch
 * $g->deleteBranch();
 */
/*
 * Pull from remote
 * $g->pull();
 */
/*
 * Push to remote
 * $g->push();
 */