<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public function view() {
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

        $setMsgValue = array();
        $setMsgValue['alertDanger'] = '';
        $setMsgValue['msg'] = '';

        $this->load->model('projects');
        $projectid = $this->input->get()['id'];
        $hookurl = BASE_URL."/".$projectid;

        // $jsonResponse = file_get_contents("php://input");
        $jsonResponse = '{
            "ref": "refs/heads/master",
            "before": "add45e783296f19cde7495e0d76a920bad14fd3f",
            "after": "cc68127a5a1db2ab665c7e263dca1ba4a233d984",
            "created": false,
            "deleted": false,
            "forced": false,
            "base_ref": null,
            "compare": "https://github.com/stambe/dummytext/compare/add45e783296...cc68127a5a1d",
            "commits": [{
                "id": "cc68127a5a1db2ab665c7e263dca1ba4a233d984",
                "distinct": true,
                "message": "Changed webhook and git.sh",
                "timestamp": "2016-03-01T17:51:27+05:30",
                "url": "https://github.com/stambe/dummytext/commit/cc68127a5a1db2ab665c7e263dca1ba4a233d984",
                "author": {
                    "name": "Sagar Tambe",
                    "email": "sagar@cuelogic.co.in",
                    "username": "stambe"
                },
                "committer": {
                    "name": "Sagar Tambe",
                    "email": "sagar@cuelogic.co.in",
                    "username": "stambe"
                },
                "added": [],
                "removed": [],
                "modified": ["git.sh", "webhook.php"]
            }],
            "head_commit": {
                "id": "cc68127a5a1db2ab665c7e263dca1ba4a233d984",
                "distinct": true,
                "message": "Changed webhook and git.sh",
                "timestamp": "2016-03-01T17:51:27+05:30",
                "url": "https://github.com/stambe/dummytext/commit/cc68127a5a1db2ab665c7e263dca1ba4a233d984",
                "author": {
                    "name": "Sagar Tambe",
                    "email": "sagar@cuelogic.co.in",
                    "username": "stambe"
                },
                "committer": {
                    "name": "Sagar Tambe",
                    "email": "sagar@cuelogic.co.in",
                    "username": "stambe"
                },
                "added": [],
                "removed": [],
                "modified": ["git.sh", "webhook.php"]
            },
            "repository": {
                "id": 52711711,
                "name": "dummytext",
                "full_name": "stambe/dummytext",
                "owner": {
                    "name": "stambe",
                    "email": "sagar@cuelogic.co.in"
                },
                "private": false,
                "html_url": "https://github.com/stambe/dummytext",
                "description": "",
                "fork": false,
                "url": "https://github.com/stambe/dummytext",
                "forks_url": "https://api.github.com/repos/stambe/dummytext/forks",
                "keys_url": "https://api.github.com/repos/stambe/dummytext/keys{/key_id}",
                "collaborators_url": "https://api.github.com/repos/stambe/dummytext/collaborators{/collaborator}",
                "teams_url": "https://api.github.com/repos/stambe/dummytext/teams",
                "hooks_url": "https://api.github.com/repos/stambe/dummytext/hooks",
                "issue_events_url": "https://api.github.com/repos/stambe/dummytext/issues/events{/number}",
                "events_url": "https://api.github.com/repos/stambe/dummytext/events",
                "assignees_url": "https://api.github.com/repos/stambe/dummytext/assignees{/user}",
                "branches_url": "https://api.github.com/repos/stambe/dummytext/branches{/branch}",
                "tags_url": "https://api.github.com/repos/stambe/dummytext/tags",
                "blobs_url": "https://api.github.com/repos/stambe/dummytext/git/blobs{/sha}",
                "git_tags_url": "https://api.github.com/repos/stambe/dummytext/git/tags{/sha}",
                "git_refs_url": "https://api.github.com/repos/stambe/dummytext/git/refs{/sha}",
                "trees_url": "https://api.github.com/repos/stambe/dummytext/git/trees{/sha}",
                "statuses_url": "https://api.github.com/repos/stambe/dummytext/statuses/{sha}",
                "languages_url": "https://api.github.com/repos/stambe/dummytext/languages",
                "stargazers_url": "https://api.github.com/repos/stambe/dummytext/stargazers",
                "contributors_url": "https://api.github.com/repos/stambe/dummytext/contributors",
                "subscribers_url": "https://api.github.com/repos/stambe/dummytext/subscribers",
                "subscription_url": "https://api.github.com/repos/stambe/dummytext/subscription",
                "commits_url": "https://api.github.com/repos/stambe/dummytext/commits{/sha}",
                "git_commits_url": "https://api.github.com/repos/stambe/dummytext/git/commits{/sha}",
                "comments_url": "https://api.github.com/repos/stambe/dummytext/comments{/number}",
                "issue_comment_url": "https://api.github.com/repos/stambe/dummytext/issues/comments{/number}",
                "contents_url": "https://api.github.com/repos/stambe/dummytext/contents/{+path}",
                "compare_url": "https://api.github.com/repos/stambe/dummytext/compare/{base}...{head}",
                "merges_url": "https://api.github.com/repos/stambe/dummytext/merges",
                "archive_url": "https://api.github.com/repos/stambe/dummytext/{archive_format}{/ref}",
                "downloads_url": "https://api.github.com/repos/stambe/dummytext/downloads",
                "issues_url": "https://api.github.com/repos/stambe/dummytext/issues{/number}",
                "pulls_url": "https://api.github.com/repos/stambe/dummytext/pulls{/number}",
                "milestones_url": "https://api.github.com/repos/stambe/dummytext/milestones{/number}",
                "notifications_url": "https://api.github.com/repos/stambe/dummytext/notifications{?since,all,participating}",
                "labels_url": "https://api.github.com/repos/stambe/dummytext/labels{/name}",
                "releases_url": "https://api.github.com/repos/stambe/dummytext/releases{/id}",
                "deployments_url": "https://api.github.com/repos/stambe/dummytext/deployments",
                "created_at": 1456647801,
                "updated_at": "2016-03-01T11:40:57Z",
                "pushed_at": 1456834903,
                "git_url": "git://github.com/stambe/dummytext.git",
                "ssh_url": "git@github.com:stambe/dummytext.git",
                "clone_url": "https://github.com/stambe/dummytext.git",
                "svn_url": "https://github.com/stambe/dummytext",
                "homepage": null,
                "size": 3,
                "stargazers_count": 0,
                "watchers_count": 0,
                "language": "PHP",
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
                "name": "stambe",
                "email": "sagar@cuelogic.co.in"
            },
            "sender": {
                "login": "stambe",
                "id": 4905621,
                "avatar_url": "https://avatars.githubusercontent.com/u/4905621?v=3",
                "gravatar_id": "",
                "url": "https://api.github.com/users/stambe",
                "html_url": "https://github.com/stambe",
                "followers_url": "https://api.github.com/users/stambe/followers",
                "following_url": "https://api.github.com/users/stambe/following{/other_user}",
                "gists_url": "https://api.github.com/users/stambe/gists{/gist_id}",
                "starred_url": "https://api.github.com/users/stambe/starred{/owner}{/repo}",
                "subscriptions_url": "https://api.github.com/users/stambe/subscriptions",
                "organizations_url": "https://api.github.com/users/stambe/orgs",
                "repos_url": "https://api.github.com/users/stambe/repos",
                "events_url": "https://api.github.com/users/stambe/events{/privacy}",
                "received_events_url": "https://api.github.com/users/stambe/received_events",
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
            $commitexists = $this->projects->checkCommitExists(base64_decode($projectid)); 
            
            if (is_array($commitexists) >0 && count($commitexists)>0) {
                $this->projects->updateCommitInfo($commitInfo, (int)$commitexists[0]['id']); 
            } else {
                $this->projects->addCommit($commitInfo); 
            }
        }
        
        $this->load->view('header', $setMsgValue);
        $this->load->view('Project/hook', array("hookurl" => $hookurl));
        $this->load->view('footer');
    }
}
