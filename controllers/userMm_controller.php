<?php
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class UserMmController{
        public function index_userMm($param = NULL)
        {
            $memberList = Member::getAllMember();
            $memberYearList =  Member::getMemberByYear();
            $memberListYear = Member::getAllMemberByYear();
            include('views/userMm/index_userMm.php');
        }
        public function validateUsername($param = NULL)
        {
            Member::validateUsername($param['username']);
        }
        public function addMember($param = NULL)
        {
            $check = Member::addMemberMm($param['fname'],$param['lname'],$param['username'],$param['passwd'],$param['type']);
            $link = 'location:index.php?controller=userMm&action=index_userMm';
            if($check)
            {
                header($link.'&success=4');
            }
            else
            {
                header($link.'&error=4');
            }
        }
        public function validateCode($param = NULL)
        {
            Member::validateCode($param['id_code']);
        }
        public function addMemberSys($param = NULL)
        {
           $check = Member::addMemberSys($param['id_member']);
           header('location:index.php?controller=userMm&action=index_userMm');
        }
        public function updateMember($param = NULL)
        {
            $check = Member::updateMember($param['id_member'],$param['id_code'],$param['fname'],$param['lname'],$param['type']);
            $link = 'location:index.php?controller=userMm&action=index_userMm';
            if($check)
            {
                header($link.'&success=6');
            }
            else
            {
                header($link.'&error=6');
            }
        }
        public function updatePassMember($param = NULL)
        {
            $check = Member::updatePassMember($param['id_member'],$param['passwd']);
            $link = 'location:index.php?controller=userMm&action=index_userMm';
            if($check)
            {
                header($link.'&success=5');
            }
            else
            {
                header($link.'&error=5');
            }
        }
        public function index_workMm($param  = NULL)
        {
            $workList = Work::getAllWork();
            $personList = Member::getMemberByYear();
            $patronList = Member::getAllStaff();
            include('views/userMm/index_workMm.php');
        }
        public function delete_workMm($param  = NULL)
        {
            if($_SESSION['member']['type'] !='นิสิต')
            $check = Work::deleteWork($param['id_work']);
            header('location:index.php?controller=userMm&action=index_workMm');
        }
        public function deleteUser($param = NULL)
        {
            $check = Member::deleteUser($param['id_member']);
            $link = 'location:index.php?controller=userMm&action=index_userMm';
            if($check)
            {
                header($link.'&success=7');
            }
            else
            {
                header($link.'&error=7');
            }
        }
    }
?>