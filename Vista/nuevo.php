 <div id="ContainerPanel" class="ContainerPanel">
        <div id="header" class="collapsePanelHeader">
            <div id="dvHeaderText" class="HeaderContent">jQuery Collapsible Panel1</div>
            <div id="dvArrow" class="ArrowExpand"></div>
        </div>
        <div id="dvContent" class="Content" style="display:none">
            <form>
                <input type="text" />
            </form> 
        </div>
   </div>
<br />      
   <div id="Div1" class="ContainerPanel">
        <div id="Div2" class="collapsePanelHeader">
        <div id="Div11" class="HeaderContent">jQuery Collapsible Panel2</div>
            <div id="Div3" class="ArrowExpand"></div>
        </div>
        <div class="Content" style="display:none">
            <form>
                <input type="text" />
            </form> 
        </div>
   </div> 
<br />
   <div id="Div4" class="ContainerPanel">
        <div id="Div5" class="collapsePanelHeader">
             <div id="Div12" class="HeaderContent">jQuery Collapsible Panel3</div>
            <div id="Div6" class="ArrowExpand"></div>
        </div>
        <div class="Content" style="display:none">
           <form>
                <input type="text" />
            </form> 
        </div>
    </div>   
<br />
    <div id="Div7" class="ContainerPanel">
        <div id="Div8" class="collapsePanelHeader">
             <div id="Div13" class="HeaderContent">jQuery Collapsible Panel4</div>
            <div id="Div9" class="ArrowExpand"></div>
        </div>
        <div id="Div10" class="Content" style="display:none">
           /*Content*/
        </div>
      </div>


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
       background-repeat:repeat-x;
       color:#000000;
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
       background-image: url(CollapsiblePanel/images/expand_blue.jpg);
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
       background-image: url(CollapsiblePanel/images/collapse_blue.jpg);
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
 
<script src="CollapsiblePanel/_scripts/jquery-1.2.6.js" type="text/javascript"></script>
        <script language="javascript">
            $(document).ready(function() {
                $("DIV.ContainerPanel > DIV.collapsePanelHeader > DIV.ArrowExpand").toggle(
                function() {
                    $(this).parent().next("div.Content").show("fast");
                    $(this).attr("class", "ArrowClose");
                },
                function() {                   
                    $(this).parent().next("div.Content").hide("fast");
                    $(this).attr("class", "ArrowExpand");
                });             
 
            });           
        </script>