<%@ Page Language="C#" AutoEventWireup="true" CodeFile="CollapsiblePanel.aspx.cs" Inherits="CollapsiblePanel" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<style>
/*CollapsiblePanel*/
.ContainerPanel
{
	width:400px;
	border:1px;
	border-color:#1052a0;	
	border-style:double double double double;
}
.collapsePanelHeader
{
	width:400px;
	height:30px;
	background-image: url(images/bg-menu-main.png);
	background-repeat:repeat-x;
	color:#FFF;
	font-weight:bold;
}
.HeaderContent
{
	float:left;
	padding-left:5px;
}
.Content
{
	
}
.ArrowExpand
{
	background-image: url(images/expand_blue.jpg);
	width:13px;
	height:13px;
	float:right;
	margin-top:7px;
	margin-right:5px;
}
.ArrowExpand:hover
{
	cursor:hand;
}
.ArrowClose
{
	background-image: url(images/collapse_blue.jpg);
	width:13px;
	height:13px;
	float:right;
	margin-top:7px;
	margin-right:5px;
}
.ArrowClose:hover
{
	cursor:hand;
}
</style>
    <title></title>
       <script src="_scripts/jquery-1.2.6.js" type="text/javascript"></script>
        <script language="javascript">
            $(document).ready(function() {
                $("DIV.ContainerPanel > DIV.collapsePanelHeader > DIV.ArrowExpand").toggle(
                function() {
                $(this).parent().next("div.Content").show("slow");
                 $(this).attr("class", "ArrowClose");
                },
                function() {
                $(this).parent().next("div.Content").hide("slow");
                $(this).attr("class", "ArrowExpand");
                });


            });            
        </script>
</head>
<body>
    <form id="form1" runat="server">
    <div>

         <div id="ContainerPanel" class="ContainerPanel">
        <div id="header" class="collapsePanelHeader"> 
            <div id="dvHeaderText" class="HeaderContent">jQuery Collapsible Panel1</div>
            <div id="dvArrow" class="ArrowExpand"></div>
        </div>
        <div id="dvContent" class="Content" style="display:none">
            In Album List Page, we will display 3 albums in a row in Tiled format i.e. to repeat the display 
            of items horizontally, Refer Figure 1. To create a new Album, a “Create 
            New Album” link will be displayed at the end of the ListView control. 
            This link will be automatically moved to the last column of the ListView 
            control whenever a new Album is added. We will see how this can be implemented 
            with ListView control.

            To display data in ListView control, we have to first define the mandatory templates, 
            Layout Template and Item Template.  Read my previous article - ListView Control in 
            ASP.Net 3.5 to gain more knowledge on this.

            Additionally, we will use Group Template to group the data in tiled format. 
            We can restrict the number of items in a row by using a property called GroupItemCount. 

            To display “Create New Album” link, we can use another ListView template called 
            InsertItemTemplate. The content in InsertItemTemplate will be displayed to insert 
            a new item in the ListView.  We can set the property called InsertItemPosition to 
            dictate where we can display the InsertItemTemplate. In our case, it is LastItem.
        </div>
    </div>
           <br />
     
         <div id="Div1" class="ContainerPanel">
        <div id="Div2" class="collapsePanelHeader"> 
        <div id="Div11" class="HeaderContent">jQuery Collapsible Panel2</div>
            <div id="Div3" class="ArrowExpand"></div>
        </div>
        <div class="Content" style="display:none">
            Test
        </div>
    </div>
  
           <br />
         <div id="Div4" class="ContainerPanel">
        <div id="Div5" class="collapsePanelHeader"> 
             <div id="Div12" class="HeaderContent">jQuery Collapsible Panel3</div>
            <div id="Div6" class="ArrowExpand"></div>
        </div>
        <div class="Content" style="display:none">
            Test
        </div>
    </div>
    
           <br />
         <div id="Div7" class="ContainerPanel">
        <div id="Div8" class="collapsePanelHeader"> 
             <div id="Div13" class="HeaderContent">jQuery Collapsible Panel4</div>
            <div id="Div9" class="ArrowExpand"></div>
        </div>
        <div id="Div10" class="Content" style="display:none">
            In Album List Page, we will display 3 albums in a row in Tiled format i.e. to repeat the display 
            of items horizontally, Refer Figure 1. To create a new Album, a “Create 
            New Album” link will be displayed at the end of the ListView control. 
            This link will be automatically moved to the last column of the ListView 
            control whenever a new Album is added. We will see how this can be implemented 
            with ListView control.

            To display data in ListView control, we have to first define the mandatory templates, 
            Layout Template and Item Template.  Read my previous article - ListView Control in 
            ASP.Net 3.5 to gain more knowledge on this.

            Additionally, we will use Group Template to group the data in tiled format. 
            We can restrict the number of items in a row by using a property called GroupItemCount. 

            To display “Create New Album” link, we can use another ListView template called 
            InsertItemTemplate. The content in InsertItemTemplate will be displayed to insert 
            a new item in the ListView.  We can set the property called InsertItemPosition to 
            dictate where we can display the InsertItemTemplate. In our case, it is LastItem.
        </div>
    </div>
     
         <br />
    
    </div>
    </form>
</body>
</html>
