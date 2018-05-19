<?php
require("Bundle.php")
Class Question
{
	public function create($text, $correctAnswer, $sourceTitle, $sourceLink)
	{
		$q = R::dispense("questions");
		$q->questionText = $text;
		$q->sourceLink = $sourceLink;
		$q->sourceTitle = $sourceTitle;
		$q->questionAnswer = $correctAnswer;
		if(!R::store($q))
		{
			throw new Exception("Redbean store failure.");
		}
	}


	public static function getQuestionInfo($qid)
	{
		$qInfo = R::load("questions", $qid);
		return $qInfo;
	}

	public function getCorrectPercent($qid)
	{
		$q = $this::getQuestionInfo($qid);
		$right = R::exec("SELECT COUNT(*) FROM responses WHERE questionId = :qid AND response = :r", ["qid"=>$qid, "r"=>$q->questionAnswer]);
		$total = R::exec("SELECT COUNT(*) FROM responses WHERE questionId = :qid", ["qid"=>$qid]);
		return $right/$total;
	}

	
}