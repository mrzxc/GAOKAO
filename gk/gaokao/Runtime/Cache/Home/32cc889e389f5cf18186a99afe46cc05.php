<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>云起高考</title>

    <!-- Bootstrap -->
    <!-- // <script src="/gaokao/Public/js/json.js"></script> -->
    <link href="/gaokao/Public/css/bootstrap.min.css" rel="stylesheet">
    <script src="/gaokao/Public/js/jquery.min.js"></script>
    <script src="/gaokao/Public/js/bootstrap.min.js"></script>
    <style >
      #special{
        display: none;
      }
      .denglu{
      margin-left: 400px;
      display: inline;
    }
    header {
      height: 68px;
    }
    ul{
      height: 68px;
      margin: 0;
      padding: 0;
      list-style: none;
      padding-top: 10px;
    }
    h3{
      color: black;
    }
    p{
      margin: 0;
      padding: 0;
      display: inline;
    }
    li.first{
      float: left;
      position: relative;
      height: 68px;
      padding:0;
      margin:0;
    }
    li.second {
      float: left;
      height: 55px;
      font-family: KaiTi;
      font-size: 40px;
      width: calc(100% - 80px);
      border-bottom: 5px solid #55c28b;
    }
    .tu{
      display: inline;
      margin-top: 10px;
    }
    .biaoti {
      float: left;
    }
    nav{
      background-color: #55c28b;
      margin: 0px;
      padding: 0px;
    }
    .navbar-text{
      color:black;
      margin: 0px;
    }
    .status {
      float: right;
    }
    .container-fluid {
      margin-right: 0px;
      font-size: 24px;
    }
    .navbar-nav {
      float: right;
    }
    tbody{
      vertical-align: middle;
    }
    td{
      padding-top: 5px;
      padding-bottom: 5px;
      vertical-align: middle !important;
    }
    .zxc{
      display: inline-block;
      width: 130px;
    }

    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <header><ul>
    <li class="first"><img src="/gaokao/Public/img/yq.png" width="80" height="50"></li>
    <li class="second"><div class="biaoti">云起高考信息服务平台</div><div class="status"><?php echo ($status); ?></div></li>
  </ul></header>
    <nav class="navbar navbar-static-top " role="navgation">
        <div class="container-fluid container">
          <div id="navbar" class="collapse navbar-collapse ">
            <ul class="nav navbar-nav ">
            <li><a href="" class="navbar-text">招生计划</a></li>
            <li><a href="" class="navbar-text">招生简章</a></li>
            <li><a href="" class="navbar-text">专业信息</a></li>
            <li><a href="" class="navbar-text">高校信息</a></li>
            <li><a href="/gaokao/index.php/Home/Inqure" class="navbar-text">模拟志愿</a></li>
            </ul>
          </div>
        </div>
    </nav>
      <div class="form text-center container">
        <div class="row">
          <div class="form-group col-md-2 col-xs-6">
            <label for="type">考生文\理</label>
            <select id="type" class="form-control" name="type">
            <option value="art">文科</option>
            <option value="science">理科</option>
            </select>
          </div>
          <div class="form-group col-md-2 col-xs-6">
            <label for="province">考生所在省份</label>
            <select id="province" class="form-zxc form-control " name="province">
            <option value="10000">上海</option>
            <option value="10001">云南</option>
            <option value="10002">内蒙古</option>
            <option value="10003">北京</option>
            <option value="10004">吉林</option>
            <option value="10005">四川</option>
            <option value="10006">天津</option>
            <option value="10007">宁夏</option>
            <option value="10008">安徽</option>
            <option value="10009">山东</option>
            <option value="10010">山西</option>
            <option value="10011">广东</option>
            <option value="10012">广西</option>
            <option value="10013">新疆</option>
            <option value="10014">江苏</option>
            <option value="10015">江西</option>
            <option value="10016">河北</option>
            <option value="10017">河南</option>
            <option value="10018">浙江</option>
            <option value="10019">海南</option>
            <option value="10020">香港</option>
            <option value="10021">湖北</option>
            <option value="10022">湖南</option>
            <option value="10023">甘肃</option>
            <option value="10024">福建</option>
            <option value="10025">西藏</option>
            <option value="10026">贵州</option>
            <option value="10027">辽宁</option>
            <option value="10028">重庆</option>
            <option value="10029">陕西</option>
            <option value="10030">青海</option>
            <option value="10031">黑龙江</option>
            <option value="10145">澳门</option>
            <option value="10146">台湾</option>
            </select>
          </div>
          <div class="form-group col-md-2 col-xs-6">
            <label for="subgrade">考生成绩在</label>
            <select id="enroll_level" class="form-control" name="enroll_level">
              <option value="本科一批">本科一批</option>
              <option value="本科二批">本科二批</option>
            </select>
          </div>
          <div class="zxc form-group col-md-2 col-xs-6">
            <label for="subgrade">高于分数线分数</label>
            <input id="subgrade" class="form-control" type="text" value="0" name="subgrade">
          </div>
          <div class="zxc form-group col-md-2 col-xs-6">
            <label for="range">查询的范围</label>
            <input id="range" class="form-control" type="text" value="0" name="range" >
          </div>
          <div class="form-group col-md-2 col-xs-6">
            <label for="specialname">专业</label>
            <input id="specialname" class="form-control" type="text" name="specialname" >
          </div>
        </div>
      <div class="container">
        <table class="table table-striped table-bordered" id＝"table">
        <thead>
        <tr>
          <td>学校</td>
          <td>年份</td>
          <td>最高分</td>
          <td>平均分</td>
          <td>省控线</td>
          <td>是否可录取</td>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($schoolname); ?></td>
        <td><?php echo ($data["year"]); ?></td>
        <td><?php echo ($data["max"]); ?></td>
        <td><?php echo ($data["average"]); ?></td>
        <td><?php echo ($data["provinceline"]); ?></td>
        <td><?php echo ($data["upsize"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        </table>
      </div>
          <!-- // <script src="/gaokao/Public/js/requst.js"></script> -->
  </body>
</html>