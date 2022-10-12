<?php

use App\Models\Member;
use App\Models\Team;
use App\Models\Branch;
use App\Models\Applications;

class Admin {

	public static function memberFullName($id) {
		$data = Member::whereId($id)->first();
		return ucfirst($data->first_name.' '.$data->last_name);
	}

	public static function teamCode() {
		$count = Team::withTrashed()->count();
        return "T".sprintf("%'03d", ++$count);
    }

    public static function getTeamCode($id) {
        return "T".sprintf("%'03d", $id);
    }

    public static function branchCode() {
		$count = Branch::withTrashed()->count();
        return "B".sprintf("%'03d", ++$count);
    }

    public static function getBranchCode($id) {
        return "B".sprintf("%'03d", $id);
    }

    public static function memberCode() {
		$count = Member::withTrashed()->count();
        return "M".sprintf("%'03d", ++$count);
    }

    public static function getMemberCode($id) {
        return "M".sprintf("%'03d", $id);
    }

    public static function applicationCode($memberId,$teamId,$branchId) {
    	$member = Member::whereId($memberId)->first();
    	$team = Team::whereId($teamId)->first();
    	$branch = Branch::whereId($branchId)->first();
    	$memberApplicationCount = Applications::whereId($memberId)->withTrashed()->count();
		$applicationCount = Applications::withTrashed()->count();

		if($applicationCount == "99999" && $applicationCount > "99999") {
			$count = ++$applicationCount;
		} else {
			$count = sprintf("%'05d", ++$applicationCount);
		}

		return "App-".$member->member_code."-".$team->team_code."-".$branch->branch_code."-".++$memberApplicationCount."-".$count;
    }

    public static function getApplicationCode($id) {
    	$application = Applications::whereId($id)->first();

    	$applicationId = $application->id;
    	$memberId = $application->member_id;
    	$teamId = $application->team_id;
    	$branchId = $application->branch_id;

    	$member = Member::whereId($memberId)->first();
    	$team = Team::whereId($teamId)->first();
    	$branch = Branch::whereId($branchId)->first();
    	$memberApplicationCount = Applications::whereId($memberId)->withTrashed()->count();
		$applicationCount = Applications::withTrashed()->count();

		if($applicationId== "99999" && $applicationId> "99999") {
			$count = $applicationId;
		} else {
			$count = sprintf("%'05d", $applicationId);
		}

		return "App-".$member->member_code."-".$team->team_code."-".$branch->branch_code."-".++$memberApplicationCount."-".$count;
    }
	
}