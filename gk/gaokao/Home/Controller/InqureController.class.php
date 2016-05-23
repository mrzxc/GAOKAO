<?phpnamespace Home\Controller;use Think\Controller;class InqureController extends Controller {    public function index()    {        if (!empty(cookie("username"))) {            $status = '<a href="/gaokao/index.php/Home/Login/quit"><h3 class="denglu col-xs-12">退出登录</h3></a>';            $this->assign('status',$status);            $this->display();        }else{            $this->error('请您先登录','/gaokao/index.php/Home/Index');        }    }    public function requst()    {        $method = I('post.method');        $data = $this->method($method);        $this->ajaxReturn($data,"json");    }    public function detail()    {        $type = I("get.type");        $enroll_level = I("get.enroll_level");        $provinceid = I("get.province");        $data['subgrade'] = I("get.subgrade");        $data['range'] = I('get.range');        $year = I("get.year");        $schoolname = I("get.schoolname");        $batch = M('Batch_controlline');        //查学校id        $scn = M('school');        $school = $scn->where("SchoolName='%s'",$schoolname)->find();        $schoolid = $school["schoolid"];        $sch = M("provinceline_$type");        $conditionAll = [            'SchoolId' => $schoolid,            'ProvinceId' => $provinceid,            'Batch' => $enroll_level        ];        $info1=$info = $sch->where($conditionAll)->select();        // de_bug($info);        for ($i=0; $i < count($info1); $i++) {            $batch = M('Batch_controlline');            $b = $batch->where("Type='%s' and Year='%s' and ProvinceId='%s' and Batch='%s'",$type,$info1[$i]['year'],$provinceid,$enroll_level)->find();            $provinceline = $b['provinceline'];        //设置查询分数范围            $downline = $provinceline+$data["subgrade"]-$data['range'];            $upline = $provinceline+$data["subgrade"]+$data['range'];        //在分数范围内的学校            $condition = [                'Average' => array(array('egt',$downline),array('elt',$upline)),                'Year' => $info1[$i]['year'],                'ProvinceId' => $provinceid,                'Batch' => $enroll_level,                'SchoolId' => $schoolid            ];            $scdata = $sch->where($condition)->find();            $info[$i]['upsize'] = $scdata ? '&radic;' : '&Chi;';        }        // var_dump($info);        $this->assign('schoolname',$schoolname);        $this->assign('info',$info);        $this->display();        // for ($i=0; $i < 3; $i++) {        //     $provinceline = $b["$i"]['provinceline'];        // //设置查询分数范围        //     $downline = $provinceline+$data["subgrade"]-$data['range'];        //     $upline = $provinceline+$data["subgrade"]+$data['range'];        // //在分数范围内的学校        //     $condition = [        //         'Average' => array(array('egt',$downline),array('elt',$upline)),        //         'Year' => (string)("201".$i+2),        //         'ProvinceId' => $data['provinceid'],        //         'Batch' => $data['enroll_level']        //     ];        //     $scdata[$i] = $sch->where($condition)->select();        // }        // for ($i=0; $i < count($preinfo); $i++) {        //     for ($j=0; $j < 10; $j++) {        //         $finalCondition = [        //             'Year'  => 2012+$j,        //             'Batch' => $data['enroll_level'],        //             'ProvinceId' => $data['provinceid'],        //             'SchoolId'  => end($preinfo[$i])['schoolid']        //         ];        //         $info[$i][$j] = $sch->where($finalCondition)->find();        //         $info[$i][$j]['sizeup'] = !empty($preinfo[$i][$j]) ? true:false;        //     }        // }        // $scn = M('school');        // for ($i=0; $i<count($preinfo); $i++) {        //     //根据schoolid查询学校名字        //     $school = $scn->where("SchoolId='%s'",end($preinfo[$i])["schoolid"])->find();        //     $info[$i]["schoolname"] = $school["schoolname"];        // }    }    private function method($method)    {        switch($method){            case 'SchoolRefer':                $postdata['type'] = I("post.type");                $postdata['enroll_level'] = I("post.enroll_level");                $postdata['provinceid'] = I("post.province");                $postdata['subgrade'] = I("post.subgrade");                $postdata['range'] = I('post.range');                $returndata = $this->getSchool($postdata);                // var_dump($returndata);                break;            case 'two':                $postdata['type'] = I("post.type");                $postdata['enroll_level'] = I("post.enroll_level");                $postdata['provinceid'] = I("post.province");                $postdata['subgrade'] = I("post.subgrade");                $postdata['range'] = I('post.range');                $postdata['year'] = I("post.year");                $returndata = $this->getSchoolSpecial($postdata);                // echo "dasda";                break;            case 'SpecialRefer':                $postdata['type'] = I("post.type");                $postdata['enroll_level'] = I("post.enroll_level");                $postdata['provinceid'] = I("post.province");                $postdata['subgrade'] = I("post.subgrade");                $postdata['range'] = I('post.range');                $postdata['year'] = I("post.year");                $postdata['specialname'] = I("post.specialname");                $returndata = $this->getSpecial($postdata);                break;            default:                $this->error('查询方式错误');        }        return $returndata;    }    private function getSchool($data)    {        $type = $data['type'];        $batch = M('Batch_controlline');        $b[0] = $batch->where("Type='%s' and Year=2012 and ProvinceId='%s' and Batch='%s'",$data['type'],$data['provinceid'],$data['enroll_level'])->find();        $b[1] = $batch->where("Type='%s' and Year=2013 and ProvinceId='%s' and Batch='%s'",$data['type'],$data['provinceid'],$data['enroll_level'])->find();        $b[2] = $batch->where("Type='%s' and Year=2014 and ProvinceId='%s' and Batch='%s'",$data['type'],$data['provinceid'],$data['enroll_level'])->find();        //查询三年内可录取的学校之和        $sch = M("provinceline_$type");        for ($i=0; $i < 3; $i++) {            $provinceline = $b["$i"]['provinceline'];        //设置查询分数范围            $downline = $provinceline+$data["subgrade"]-$data['range'];            $upline = $provinceline+$data["subgrade"]+$data['range'];        //在分数范围内的学校            $condition = [                'Average' => array(array('egt',$downline),array('elt',$upline)),                'Year' => (string)("201".$i+2),                'ProvinceId' => $data['provinceid'],                'Batch' => $data['enroll_level']            ];            $scdata[$i] = $sch->where($condition)->select();        }        $scdatapr = [            0 =>$scdata[0],            1 =>$scdata[1],            2 =>$scdata[2]        ];        //将三年的数据合并到一起(有重复学校)        $scdata = array_merge($scdatapr[0], $scdatapr[1]);        $scdata = array_merge($scdata, $scdatapr[2]);        //把三年数据整理        $preinfo=[];        foreach ($scdata as $key => $value) {            $IfExist = false;            $repeatKey = 0;            $prekey = $value['year'] - 2012;            foreach ($preinfo as $keypre => $valuepre) {                if ($value['schoolid'] == end($valuepre)['schoolid']) {                    $IfExist = true;                    $repeatKey = $keypre;                }            }            if (!$IfExist) {                $exp[][$prekey] = $scdata[$key];                $preinfo = $preinfo + $exp;            }else{                $preinfo[$repeatKey][$prekey] = $scdata[$key];            }        }        //得到学校这三年的数据        for ($i=0; $i < count($preinfo); $i++) {            for ($j=0; $j < 3; $j++) {                $finalCondition = [                    'Year'  => 2012+$j,                    'Batch' => $data['enroll_level'],                    'ProvinceId' => $data['provinceid'],                    'SchoolId'  => end($preinfo[$i])['schoolid']                ];                $info[$i][$j] = $sch->where($finalCondition)->find();                $info[$i][$j]['sizeup'] = !empty($preinfo[$i][$j]) ? true:false;            }        }        $scn = M('school');        for ($i=0; $i<count($preinfo); $i++) {            //根据schoolid查询学校名字            $school = $scn->where("SchoolId='%s'",end($preinfo[$i])["schoolid"])->find();            $info[$i]["schoolname"] = $school["schoolname"];        }        return $info;    }    private function getSpecial($data)    {        //得到三年分数线        $type = $data['type'];        $batch = M('Batch_controlline');        $b[0] = $batch->where("Type='%s' and Year=2012 and ProvinceId='%s' and Batch='%s'",$data['type'],$data['provinceid'],$data['enroll_level'])->find();        $b[1] = $batch->where("Type='%s' and Year=2013 and ProvinceId='%s' and Batch='%s'",$data['type'],$data['provinceid'],$data['enroll_level'])->find();        $b[2] = $batch->where("Type='%s' and Year=2014 and ProvinceId='%s' and Batch='%s'",$data['type'],$data['provinceid'],$data['enroll_level'])->find();        //查询三年内可录取的学校之和        $spe = M("special_line_$type");        for ($i=0; $i < 3; $i++) {            $provinceline = $b["$i"]['provinceline'];        //设置查询分数范围            $downline = $provinceline+$data["subgrade"]-$data['range'];            $upline = $provinceline+$data["subgrade"]+$data['range'];        //在分数范围内的学校            $condition = [                'Avg' => array(array('egt',$downline),array('elt',$upline)),                'Year' => (string)("201".$i+2),                'ProvinceId' => $data['provinceid'],                'SpecialName' => $data['specialname'],                'Batch' => $data['enroll_level']            ];            $scdata[$i] = $spe->where($condition)->select();        }        $scdatapr = [            0 =>$scdata[0],            1 =>$scdata[1],            2 =>$scdata[2]        ];        //将三年的数据合并到一起(有重复学校)        $scdata = array_merge($scdatapr[0], $scdatapr[1]);        $scdata = array_merge($scdata, $scdatapr[2]);        //把三年数据整理        $preinfo=[];        foreach ($scdata as $key => $value) {            $IfExist = false;            $repeatKey = 0;            $prekey = $value['year'] - 2012;            foreach ($preinfo as $keypre => $valuepre) {                if ($value['schoolid'] == end($valuepre)['schoolid']) {                    $IfExist = true;                    $repeatKey = $keypre;                }            }            if (!$IfExist) {                $exp[][$prekey] = $scdata[$key];                $preinfo = $preinfo + $exp;            }else{                $preinfo[$repeatKey][$prekey] = $scdata[$key];            }        }        //得到学校这三年的数据        for ($i=0; $i < count($preinfo); $i++) {            for ($j=0; $j < 3; $j++) {                $finalCondition = [                    'Year'  => 2012+$j,                    'Batch' => $data['enroll_level'],                    'ProvinceId' => $data['provinceid'],                    'SchoolId'  => end($preinfo[$i])['schoolid']                ];                $info[$i][$j] = $spe->where($finalCondition)->find();                $info[$i][$j]['sizeup'] = !empty($preinfo[$i][$j]) ? true:false;            }        }        $scn = M('school');        for ($i=0; $i<count($preinfo); $i++) {            //根据schoolid查询学校名字            $school = $scn->where("SchoolId='%s'",end($preinfo[$i])["schoolid"])->find();            $info[$i]["schoolname"] = $school["schoolname"];        }        //查询分数线        // $lineCondition = array(        //     "Type"          =>  $data['type'],        //     "Year"          =>  $data['year'],        //     "ProvinceId"    =>  $data['provinceid'],        //     "Batch"         =>  $data['enroll_level']        //     );        // $batch = M('Batch_controlline');        // $b = $batch->where($lineCondition)->find();        // if (is_null($b)) {        //     return $this->error('抱歉没有此数据');        // }        // $provinceline = $b["provinceline"];        // //设置查询分数范围        // $downline = $provinceline+$data["subgrade"]-$data['range'];        // $upline = $provinceline+$data["subgrade"]+$data['range'];        // $type = $data['type'];        // $specialCondition = [        //     'Batch'         => $data['enroll_level'],        //     'Year'          => $lineCondition['Year'],        //     'ProvinceId'    => $data['provinceid'],        //     'SpecialName'   => $data['specialname'],        //     'Avg'           => array(array('egt',$downline),array('elt',$upline))        // ];        // $specialsearch = M("special_line_$type");        // $specialdata = $specialsearch->where($specialCondition)->select();        // // 查询学校名字        // $scn = M('school');        // for ($i=0; $i < count($specialdata); $i++) {        //     $school = $scn->where("SchoolId='%s'",$specialdata[$i]["schoolid"])->find();        //     $info[$i]["schoolname"] = $school["schoolname"];        //     $info[$i]["specialname"] = $specialdata[$i]["specialname"];        //     $info[$i]["average"] = $specialdata[$i]["avg"];        //     $info[$i]["max"] = $specialdata[$i]["max"];        //     //计算录取概率        //     $cond = array(        //         'Batch'     => $data['enroll_level'],        //         "SchoolId"  =>  $specialdata[$i]["schoolid"],        //         "ProvinceId"=>  $data['provinceid'],        //         'SpecialName'=>$data['specialname']        //         );        //     $perc = $specialsearch->where($cond)->select();        //     $tcount = 0;        //     $dcount = 0;        //     for ($k=0; $k < count($perc); $k++) {        //         if ($perc[$k]['provinceline'] == '') {        //             $dcount++;        //         }elseif ($perc[$k]['provinceline']+$data["subgrade"]+$data['range'] >= $perc[$k]['avg']) {        //             $tcount++;        //         }        //     }        //     $info[$i]['count'] = count($perc)-$dcount;        //     $info[$i]['tcount'] = $tcount;        // }        return $info;    }    public function getProvinceLine()    {        $data['Year'] = I("post.year");        $data['Type'] = I("post.type");        $data['ProvinceId'] = I("post.province");        $data['Batch'] = "本科一批";        // var_dump($data);        $pvl = M('Batch_controlline');        $p0 = $pvl->where($data)->select();        $data['Batch'] = "本科二批";        $p1 = $pvl->where($data)->select();        $pp = array_merge_recursive($this->sqIfNull($p0),$this->sqIfNull($p1));        $this->ajaxReturn($pp,"json");    }    private function sqIfNull($arr)    {        if ($arr == null) {            $arr[0] = ["provinceline" => "--"];        }        return $arr;    }}?>