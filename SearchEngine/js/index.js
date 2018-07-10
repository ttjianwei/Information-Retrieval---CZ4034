 // result gallery
 $('.gallery ul li a').click(function() {
     var itemID = $(this).attr('href');
     var img=$(this).find("img");
     var imgSrc=img.attr("src");

     $('.gallery ul').addClass('item_open');
     $(itemID).addClass('item_open');
     $("#imgResult").attr('src',imgSrc);
     //alert(img.attr("id").slice(3));
     /*var getArrayIndex=img.attr("id").slice(3,4);

     if(getArrayIndex==0)
         getArrayIndex=img.attr("id").slice(4);
     else
         getArrayIndex=img.attr("id").slice(3);

     $("#detailLike").text(arrayRes[getArrayIndex][2]);
     $("#detailCaption").text(arrayRes[getArrayIndex][5]);
     $("#detailCuisine").text(arrayRes[getArrayIndex][6]);
     $("#detailIgName").text(arrayRes[getArrayIndex][7]);*/
	 
	
	 
	 var getArrayIndex=img.attr("id").slice(0);
	 $("#detailLike").text(javascript_LikeArray[getArrayIndex]);
	 $("#detailCaption").text(javascript_CaptionArray[getArrayIndex]);
     $("#detailCuisine").text(javascript_CuisineArray[getArrayIndex]);
	 $("#detailIgName").text(javascript_AccountArray[getArrayIndex]);
     return false;
 });
 $('.close').click(function() {
     $('.port, .gallery ul').removeClass('item_open');
     return false;
 });

 $(".gallery ul li a").click(function() {
     $('html, body').animate({
         scrollTop: parseInt($("#top").offset().top)
     }, 400);
 });
 
 

//GLOBAL //get array from solr //json array format?
 var arrayRes=[[0,"https://instagram.fsin2-1.fna.fbcdn.net/vp/61d85cdb67848968e6690b037d6a2851/5B702E2D/t51.2885-15/e35/28158844_2035219173358952_6512603436574310400_n.jpg",8,1,
     "1520417870","Help yourselves with Burger Monster’s 8 types of FREE FLOW sauce and dressing. 😋 Drop by now! #burgermonstersg #burgermonster #jurongeast #singapore #musteatsg #mustgosg #singaporeeats #foodporn #unagiroll #koreanfood #koreanburger #sandwich","American","MacDonalds"]
     ,[1,"https://instagram.fsin2-1.fna.fbcdn.net/vp/166db2cade4f83d62f8dc66df02b6ca5/5B404E20/t51.2885-15/e35/28152120_1778955878846104_7499999169336049664_n.jpg",10,2,"1520417871","Get to try this humongous 22cm sized burger! What’s inside? Delivious premium quality bulgogi beef with authentic- homemade bulgogi sauce. It is also packed with yummy cheese- fresh tomatoes- caramelized onions and lettuce. 🍔😋 This Monster Burger is good for 3-4 pax! So- Gather up your friends and visit us NOW!. . . . . . #burgermonstersg #burgermonster #jurongeast #singapore #musteatsg #mustgosg #singaporeeats #foodporn #unagiroll #koreanfood #koreanburger #sandwich","American","KFC"]

 ];


 function search(){
     var searchValue=document.getElementById("sv").value;

     if(!searchValue){
         alert("Please enter an input!");
     }else{
         document.getElementById("resultGallery").style.visibility="visible";

         /*alert(searchValue);*/
         document.getElementById("searchValHeader").textContent=searchValue;


        /* var arrayRes=["https://instagram.fsin2-1.fna.fbcdn.net/vp/aae5025809b11ef80ac6b81d954d6458/5B70399C/t51.2885-15/e35/27894203_2037532109597373_6413168312242405376_n.jpg",
             "https://instagram.fsin2-1.fna.fbcdn.net/vp/166db2cade4f83d62f8dc66df02b6ca5/5B404E20/t51.2885-15/e35/28152120_1778955878846104_7499999169336049664_n.jpg",
             "https://instagram.fsin2-1.fna.fbcdn.net/vp/8fdcacc1175cbfa6ece8a46f9504a769/5B6C1673/t51.2885-15/e35/26303181_1921012734682934_587805809631559680_n.jpg",
             "https://instagram.fsin2-1.fna.fbcdn.net/vp/12564c9467e7d929c2ee7ea28d2a6436/5B5905AC/t51.2885-15/e35/22280274_506081529752985_1540984628867760128_n.jpg",
             "https://instagram.fsin2-1.fna.fbcdn.net/vp/f55535ab23f45ba1116868fafe8016fa/5ABC89CD/t51.2885-15/e35/26872935_367561210376925_8028331557502582784_n.jpg"];*/

        //count # of result return
        //alert(arrayRes.length);

         //dynamic load array base on # of result
         var resultID=[];var index=0;

         for(var i=0;i<arrayRes.length;i++){

             if(i<10)
                index="0"+i;
             else
                index=i;

             resultID.push('res'+index);
         }

        //display image
         for(var x=0;x<arrayRes.length;x++){
             document.getElementById(resultID[x]).src = arrayRes[x][1];
            /* document.getElementById("detailLike").textContent=arrayRes[x][2];
             document.getElementById("detailCaption").textContent=arrayRes[x][5];
             document.getElementById("detailCuisine").textContent=arrayRes[x][6];*/
         }


     }

 }





/*
 window.onload("DOMContentLoaded", function(event) {
     document.querySelectorAll('img').forEach(function(img){
         img.onerror = function(){this.src='https://upload.wikimedia.org/wikipedia/commons/e/e0/Deleted_photo.png';}
         ;})
 });

 document.addEventListener("DOMContentLoaded", function(event) {
     document.querySelectorAll('img').forEach(function(img){
         img.onerror = function(){this.src='https://upload.wikimedia.org/wikipedia/commons/e/e0/Deleted_photo.png';}
         ;})
 });*/

