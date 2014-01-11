<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<script src="/dhtmlx/grid/dhtmlxcommon.js" 	type="text/javascript" charset="utf-8"></script>
	<script src="/dhtmlx/grid/dhtmlxgrid.js" 	type="text/javascript" charset="utf-8"></script>
	<script src="/dhtmlx/grid/dhtmlxgridcell.js" 	type="text/javascript" charset="utf-8"></script>
 
	<script src="/dhtmlx/dhtmlxdataprocessor.js" 	type="text/javascript" charset="utf-8"></script>
	<script src="/dhtmlx/connector/connector.js" 	type="text/javascript" charset="utf-8"></script>
 
	<link rel="stylesheet" href="/dhtmlx/grid/dhtmlxgrid.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="/dhtmlx/grid/skins/dhtmlxgrid_dhx_skyblue.css" type="text/css" media="screen" title="no title" charset="utf-8">	
</head>
 
<body>
	<div id="grid_here" style="width:600px; height:400px;"> </div>
 
        <script type="text/javascript" charset="utf-8">
	     mygrid = new dhtmlXGridObject('grid_here'); 
	     mygrid.setHeader("Start date,End date,Text");
	     mygrid.init();                           
	     mygrid.loadXML("./data"); //refers to the 'data' action that we will create in the next step
 
	     var dp = new dataProcessor("./data"); //refers to the 'data' action as well
	     dp.action_param = "dhx_editor_status";
	     dp.init(mygrid);
 
        </script>
</body>