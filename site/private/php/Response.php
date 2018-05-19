<?php
require("Bundle.php");
Class Response
{
	public function create($uid, $qid, $response)
	{
		$r = R::dispense("responses");
		$r->userId = $uid;
		$r->questionId = $qid;
		$r->response = $response;
		if(!R::store($r))
		{
			throw new Exception("Redbean store failure.");
		}
	}

	public getAllQResponses($qid)
	{
		$responses = R::exec("SELECT * FROM responses WHERE questionId = :qid", ["qid"=>$qid]);
		return $responses;
	}
	public getAllUResponses($uid)
	{
		$responses = R::exec("SELECT * FROM responses WHERE userId = :uid", ["uid"=>$uid]);
		return $responses;
	}

}