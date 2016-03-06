<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public function view() {
        /**
         * Check value is set or not if not then redirect to login page
         */
        if (!(int)$this->session->userdata('user')['id'] > 0) {
            redirect(base_url('Auth/login'));
        }

        $arrSetData = array();
        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        $this->load->model('projects');
        $projectDetails = $this->projects->getProjectList();

        if(is_array($projectDetails)) {
            $arrSetData['setProjectDetails'] = $projectDetails;
        }

		$this->load->view('header', $setMsgValue);
        $this->load->view('Project/list', $arrSetData);
        $this->load->view('footer');
	}

    public function add() {

        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        /**
         * Check value is set or not if not then redirect to login page
         */
        if (!(int)$this->session->userdata('user')['id'] > 0) {
            redirect(base_url('Auth/login'));
        }

        $projectinfo = $this->input->post();
        $get = $this->input->get();

        $this->load->model('projects');

        if($projectinfo) {

            if((int)base64_decode($get['id']) > 0) {
                $projectId = $this->projects->edit();
            } else {
                $projectId = $this->projects->add();
            }

            if($projectId > 0) {
                $this->gitclone($projectId);

                redirect(base_url('Project/hook?id='.base64_encode($projectId)));
            }
        }

        if((int)base64_decode($get['id']) > 0) {
            $projectinfo = $this->projects->info();
        }

        $this->load->view('header', $setMsgValue);
        $this->load->view('Project/addedit', array("info" => $projectinfo[0]));
        $this->load->view('footer');
    }

    public function gitclone() {
        /**
         * Check value is set or not if not then redirect to login page
         */
        if (!(int)$this->session->userdata('user')['id'] > 0) {
            redirect(base_url('Auth/login'));
        }

        $post = $this->input->post();

        $project_name = str_replace(" ", "-", $post['project_name']);
        $git_username = $post['git_username'];
        $git_repository = $post['repository_name'];
        $git_password = $post['git_password'];
        $git_url = $post['git_url'];

        if (!file_exists('repository/$project_name/$git_repository')) {
            exec("mkdir -m 777 repository/$project_name/$git_repository");

            if ($post['repository_type'] == "public") {
                exec("git clone $git_url repository/$project_name/$git_repository");
            } else {
                $git_url_private = str_replace("github.com", $git_username.":".$git_password."@github.com", $git_url);
                exec("git clone $git_url_private repository/$project_name/$git_repository");
            }
        }
    }

    public function hook() {
        /**
         * Check value is set or not if not then redirect to login page
         */
        if (!(int)$this->session->userdata('user')['id'] > 0) {
            redirect(base_url('Auth/login'));
        }

        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        $this->load->model('commits');
        $this->load->model('projects');
        $projectid = $this->input->get()['id'];
        $hookurl = BASE_URL."/".$projectid;

        // $jsonResponse = file_get_contents("php://input");
        $jsonResponse = '{
          "ref": "refs/heads/master",
          "before": "3cb9a692f1c971a6b647b5899379a6914be16abc",
          "after": "921aa43be5ec2ee8bf4b03f7eb6f87d63edf276a",
          "created": false,
          "deleted": false,
          "forced": false,
          "base_ref": null,
          "compare": "https://github.com/tusharm-cuelogic/project-police/compare/3cb9a692f1c9...921aa43be5ec",
          "commits": [
            {
              "id": "921aa43be5ec2ee8bf4b03f7eb6f87d63edf276a",
              "distinct": true,
              "message": "worked on to get commit info",
              "timestamp": "2016-03-06T05:51:29+05:30",
              "url": "https://github.com/tusharm-cuelogic/project-police/commit/921aa43be5ec2ee8bf4b03f7eb6f87d63edf276a",
              "author": {
                "name": "tusharm-cuelogic",
                "email": "tushar.mate@cuelogic.co.in",
                "username": "tusharm-cuelogic"
              },
              "committer": {
                "name": "tusharm-cuelogic",
                "email": "tushar.mate@cuelogic.co.in",
                "username": "tusharm-cuelogic"
              },
              "added": [

              ],
              "removed": [

              ],
              "modified": [
                "application/config/database.php",
                "application/controllers/Project.php",
                "application/models/projects.php"
              ]
            }
          ],
          "head_commit": {
            "id": "921aa43be5ec2ee8bf4b03f7eb6f87d63edf276a",
            "distinct": true,
            "message": "worked on to get commit info",
            "timestamp": "2016-03-06T05:51:29+05:30",
            "url": "https://github.com/tusharm-cuelogic/project-police/commit/921aa43be5ec2ee8bf4b03f7eb6f87d63edf276a",
            "author": {
              "name": "tusharm-cuelogic",
              "email": "tushar.mate@cuelogic.co.in",
              "username": "tusharm-cuelogic"
            },
            "committer": {
              "name": "tusharm-cuelogic",
              "email": "tushar.mate@cuelogic.co.in",
              "username": "tusharm-cuelogic"
            },
            "added": [

            ],
            "removed": [

            ],
            "modified": [
              "application/config/database.php",
              "application/controllers/SearchController.php",
              "application/models/Extract.php"
            ]
          },
          "repository": {
            "id": 53187032,
            "name": "project-police",
            "full_name": "tusharm-cuelogic/project-police",
            "owner": {
              "name": "tusharm-cuelogic",
              "email": "tushar.mate@cuelogic.co.in"
            },
            "private": false,
            "html_url": "https://github.com/tusharm-cuelogic/project-police",
            "description": "",
            "fork": false,
            "url": "https://github.com/tusharm-cuelogic/project-police",
            "forks_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/forks",
            "keys_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/keys{/key_id}",
            "collaborators_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/collaborators{/collaborator}",
            "teams_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/teams",
            "hooks_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/hooks",
            "issue_events_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/issues/events{/number}",
            "events_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/events",
            "assignees_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/assignees{/user}",
            "branches_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/branches{/branch}",
            "tags_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/tags",
            "blobs_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/git/blobs{/sha}",
            "git_tags_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/git/tags{/sha}",
            "git_refs_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/git/refs{/sha}",
            "trees_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/git/trees{/sha}",
            "statuses_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/statuses/{sha}",
            "languages_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/languages",
            "stargazers_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/stargazers",
            "contributors_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/contributors",
            "subscribers_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/subscribers",
            "subscription_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/subscription",
            "commits_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/commits{/sha}",
            "git_commits_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/git/commits{/sha}",
            "comments_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/comments{/number}",
            "issue_comment_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/issues/comments{/number}",
            "contents_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/contents/{+path}",
            "compare_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/compare/{base}...{head}",
            "merges_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/merges",
            "archive_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/{archive_format}{/ref}",
            "downloads_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/downloads",
            "issues_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/issues{/number}",
            "pulls_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/pulls{/number}",
            "milestones_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/milestones{/number}",
            "notifications_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/notifications{?since,all,participating}",
            "labels_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/labels{/name}",
            "releases_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/releases{/id}",
            "deployments_url": "https://api.github.com/repos/tusharm-cuelogic/project-police/deployments",
            "created_at": 1457158663,
            "updated_at": "2016-03-05T14:46:32Z",
            "pushed_at": 1457223712,
            "git_url": "git://github.com/tusharm-cuelogic/project-police.git",
            "ssh_url": "git@github.com:tusharm-cuelogic/project-police.git",
            "clone_url": "https://github.com/tusharm-cuelogic/project-police.git",
            "svn_url": "https://github.com/tusharm-cuelogic/project-police",
            "homepage": null,
            "size": 3514,
            "stargazers_count": 0,
            "watchers_count": 0,
            "language": "HTML",
            "has_issues": true,
            "has_downloads": true,
            "has_wiki": true,
            "has_pages": false,
            "forks_count": 0,
            "mirror_url": null,
            "open_issues_count": 0,
            "forks": 0,
            "open_issues": 0,
            "watchers": 0,
            "default_branch": "master",
            "stargazers": 0,
            "master_branch": "master"
          },
          "pusher": {
            "name": "tusharm-cuelogic",
            "email": "tushar.mate@cuelogic.co.in"
          },
          "sender": {
            "login": "tusharm-cuelogic",
            "id": 5966593,
            "avatar_url": "https://avatars.githubusercontent.com/u/5966593?v=3",
            "gravatar_id": "",
            "url": "https://api.github.com/users/tusharm-cuelogic",
            "html_url": "https://github.com/tusharm-cuelogic",
            "followers_url": "https://api.github.com/users/tusharm-cuelogic/followers",
            "following_url": "https://api.github.com/users/tusharm-cuelogic/following{/other_user}",
            "gists_url": "https://api.github.com/users/tusharm-cuelogic/gists{/gist_id}",
            "starred_url": "https://api.github.com/users/tusharm-cuelogic/starred{/owner}{/repo}",
            "subscriptions_url": "https://api.github.com/users/tusharm-cuelogic/subscriptions",
            "organizations_url": "https://api.github.com/users/tusharm-cuelogic/orgs",
            "repos_url": "https://api.github.com/users/tusharm-cuelogic/repos",
            "events_url": "https://api.github.com/users/tusharm-cuelogic/events{/privacy}",
            "received_events_url": "https://api.github.com/users/tusharm-cuelogic/received_events",
            "type": "User",
            "site_admin": false
          }
        }';

        if ($jsonResponse) {

            $decodeResponse = json_decode($jsonResponse);
            $commitInfo = array(
                    "pushid" => $decodeResponse->head_commit->id,
                    "json" => $jsonResponse,
                    "username" => $decodeResponse->head_commit->committer->name,
                    "pushed_date" => date("Y-m-d h:i:s", strtotime($decodeResponse->head_commit->timestamp)),
                    "projectid" => base64_decode($projectid)
                );
            $commitexists = $this->commits->checkCommitExists(base64_decode($projectid));

            if (is_array($commitexists) >0 && count($commitexists)>0) {
                $this->commits->updateCommitInfo($commitInfo, (int)$commitexists[0]['id']);
            } else {
                $this->commits->addCommit($commitInfo);
            }

            $addedFiles = $decodeResponse->head_commit->added;
            $modifiedFiles = $decodeResponse->head_commit->modified;

            if(is_array($addedFiles) && count($addedFiles)>0) {
                foreach($addedFiles as $addedfilesname) {
                    if (strstr($addedfilesname, "controllers") || strstr($addedfilesname, "models") || strstr($addedfilesname, "helpers")) {
                        $this->curlRequest($modifiedfilesname);
                    }
                }
            }

            if(is_array($modifiedFiles) && count($modifiedFiles)>0) {
                foreach($modifiedFiles as $modifiedfilesname) {

                    if (strstr($modifiedfilesname, "controllers") || strstr($modifiedfilesname, "models") || strstr($modifiedfilesname, "helpers")) {
                        $this->curlRequest($modifiedfilesname);
                    } 
                }
            }
        }

        $this->load->view('header', $setMsgValue);
        $this->load->view('Project/hook', array("hookurl" => $hookurl));
        $this->load->view('footer');
    }

    function curlRequest($modifiedfilesname) {
        
        $this->load->model('projects');

        if((int)base64_decode($this->input->get()['id']) > 0) {
            $projectinfo = $this->projects->info();
        }

        $repoUrl = "repository/".str_replace(" ", "-", $projectinfo[0]['project_name'])."/".$projectinfo[0]['repository_name']."/";

        $url = BASE_URL."/Codereview";
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        $data = array(
            'file_path' => $repoUrl.$modifiedfilesname,
            ''
        );

        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));

        //execute post
        $result = curl_exec($ch);
        print $result;
        //close connection
        curl_close($ch);
    }
}
