$(window).scroll(function()
{
	var scrollT = document.documentElement.scrollTop || document.body.scrollTop;
	// console.log(scrollT);
	var backTop = $("#world").offset().top - $(window).height()/2;
	// console.log(backTop);
	if(scrollT > backTop)
	{
		$(".a1").addClass("animated bounceInRight show").removeClass("fade");
		$(".a2").addClass("animated bounceInDown show").removeClass("fade");
		$(".a3").addClass("animated bounceInUp show").removeClass("fade");
		$(".a4").addClass("animated bounceInLeft show").removeClass("fade");
	}
});

var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop: true,
        autoplay: 3000,
        speed: 1000,
        prevButton: '.swiper-button-prev',
        nextButton: '.swiper-button-next',
        effect: 'fade',//  effect: 'flip',effect: 'coverflow',slide', 'fade',cube
        grabCursor: true,
        cube: 
        {
            shadow: false,
            slideShadows: false,
            shadowOffset: 20,
            shadowScale: 0.94
        }
    });

//页面加载后执行
window.onload = function() 
{
	// 找到按钮
	var totop = document.getElementById("btn");
	totop.style.display="none";

	var timer=null;
	//给按钮绑定点击事件
	totop.onclick= function()
	{
		//周期性定时
		timer = setInterval(function()
		{
			//获取滚动条距离浏览器顶端的距离
			var backTop = document.documentElement.scrollTop || document.body.scrollTop;
			//越滚越慢
			var speedTop = backTop/5;
			document.documentElement.scrollTop = backTop-speedTop;
			if(backTop==0)
			{
				clearInterval(timer);
			}
		},30);
	}
	//设置临界值
	var pageHeight=700;
	//按键是否显示功能
	window.onscroll = function()
	{
		var backTop = document.documentElement.scrollTop || document.body.scrollTop;
		if(backTop=pageHeight)
		{
			totop.style.display="block";
		}
		else
		{
			totop.style.display="none";
		}
	}
}