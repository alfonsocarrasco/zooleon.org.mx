$(function() {

  $(function() {
		$("#menu").metisMenu()
	})


  $(".nav-toggle-icon").on("click", function() {
		$(".wrapper").toggleClass("toggled")
	})

    $(".mobile-menu-button").on("click", function() {
		$(".wrapper").addClass("toggled")
	})

	$(function() {
		for (var e = window.location, o = $(".metismenu li a").filter(function() {
				return this.href == e
			}).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
	})


	$(".toggle-icon").click(function() {
		$(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
			$(".wrapper").addClass("sidebar-hovered")
		}, function() {
			$(".wrapper").removeClass("sidebar-hovered")
		}))
	})



  $(".btn-mobile-filter").on("click", function() {
		$(".filter-sidebar").removeClass("d-none");
	}),
  
    $(".btn-mobile-filter-close").on("click", function() {
		$(".filter-sidebar").addClass("d-none");
	}),




  $(".mobile-search-button").on("click", function() {

    $(".searchbar").addClass("full-search-bar")

  }),

  $(".search-close-icon").on("click", function() {

    $(".searchbar").removeClass("full-search-bar")

  }),

  


  $(document).ready(function() {
		$(window).on("scroll", function() {
			$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
		}), $(".back-to-top").on("click", function() {
			return $("html, body").animate({
				scrollTop: 0
			}, 600), !1
		})
	})




  $(".dark-mode-icon").on("click", function() {

    if($(".mode-icon ion-icon").attr("name") == 'sunny-sharp') {
        $(".mode-icon ion-icon").attr("name", "moon-sharp");
        $("html").attr("class", "light-theme")
    } else {
        $(".mode-icon ion-icon").attr("name", "sunny-sharp");
        $("html").attr("class", "dark-theme")
    }

  });





  // Theme switcher 

  // $("#LightTheme").on("click", function() {
  //   $("html").attr("class", "light-theme")
  // }),

  // $("#DarkTheme").on("click", function() {
  //   $("html").attr("class", "dark-theme")
  // }),

  // $("#SemiDark").on("click", function() {
  //   $("html").attr("class", "semi-dark")
  // }),

  const btnSwitch = document.querySelector('#switch');

  btnSwitch.addEventListener('click', () => {
    // document.html.classList.toggle('semi-dark');
    document.getElementsByTagName('html')[0].classList.toggle('semi-dark');
    btnSwitch.classList.toggle('active');
  
    // Guardamos el modo en localstorage.
    if(document.getElementsByTagName('html')[0].classList.contains('semi-dark')){
      localStorage.setItem('dark-mode', 'true');
    } else {
      localStorage.setItem('dark-mode', 'false');
    }
  });
  
  // Obtenemos el modo actual.
  if(localStorage.getItem('dark-mode') === 'true'){
    document.getElementsByTagName('html')[0].classList.add('semi-dark');
    btnSwitch.classList.add('active');
    btnSwitch.checked = true;
  } else {
    document.getElementsByTagName('html')[0].classList.remove('semi-dark');
    btnSwitch.classList.remove('active');
    btnSwitch.checked = false;
  }


  // headercolor colors 

  $("#headercolor1").on("click", function() {
    $("html").addClass("color-header headercolor1"), $("html").removeClass("headercolor2 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
  }), $("#headercolor2").on("click", function() {
    $("html").addClass("color-header headercolor2"), $("html").removeClass("headercolor1 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
  }), $("#headercolor3").on("click", function() {
    $("html").addClass("color-header headercolor3"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
  }), $("#headercolor4").on("click", function() {
    $("html").addClass("color-header headercolor4"), $("html").removeClass("headercolor1 headercolor2 headercolor3 headercolor5 headercolor6 headercolor7 headercolor8")
  }), $("#headercolor5").on("click", function() {
    $("html").addClass("color-header headercolor5"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor3 headercolor6 headercolor7 headercolor8")
  }), $("#headercolor6").on("click", function() {
    $("html").addClass("color-header headercolor6"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor3 headercolor7 headercolor8")
  }), $("#headercolor7").on("click", function() {
    $("html").addClass("color-header headercolor7"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor3 headercolor8")
  }), $("#headercolor8").on("click", function() {
    $("html").addClass("color-header headercolor8"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor3")
  })


  // sidebar colors 
  $('#sidebarcolor1').click(theme1);
  $('#sidebarcolor2').click(theme2);
  $('#sidebarcolor3').click(theme3);
  $('#sidebarcolor4').click(theme4);
  $('#sidebarcolor5').click(theme5);
  $('#sidebarcolor6').click(theme6);
  $('#sidebarcolor7').click(theme7);
  $('#sidebarcolor8').click(theme8);

  function theme1() {
    $('html').attr('class', 'color-sidebar sidebarcolor1');
  }

  function theme2() {
    $('html').attr('class', 'color-sidebar sidebarcolor2');
  }

  function theme3() {
    $('html').attr('class', 'color-sidebar sidebarcolor3');
  }

  function theme4() {
    $('html').attr('class', 'color-sidebar sidebarcolor4');
  }

  function theme5() {
    $('html').attr('class', 'color-sidebar sidebarcolor5');
  }

  function theme6() {
    $('html').attr('class', 'color-sidebar sidebarcolor6');
  }

  function theme7() {
    $('html').attr('class', 'color-sidebar sidebarcolor7');
  }

  function theme8() {
    $('html').attr('class', 'color-sidebar sidebarcolor8');
  }

  if(document.querySelector('.header-notifications-list')) {
    new PerfectScrollbar(".header-notifications-list")
  }

  // Tooltops
  $(function () {
    $('[data-bs-toggle="tooltip"]').tooltip();
  })
    
});

window.addEventListener('load', function() {

  let timer = 60*60,
      display = document.querySelector('.time');
  startTimer(timer, display);

}, false);

function startTimer(duration, display) {
  let start = Date.now(),
      diff,
      minutes,
      seconds;
  function timer() {
      // get the number of seconds that have elapsed since 
      // startTimer() was called
      diff = duration - (((Date.now() - start) / 1000) | 0);

      // does the same job as parseInt truncates the float
      minutes = (diff / 60) | 0;
      seconds = (diff % 60) | 0;

      minutes = minutes < 10 ? "0" + minutes : minutes;
      seconds = seconds < 10 ? "0" + seconds : seconds;

      display.textContent = minutes + ":" + seconds;
      
      if (diff === 30) {
          // add one second so that the count down starts at the full duration
          // example 05:00 not 04:59
          document.querySelector('.timesession').classList.remove('hidden');
          document.querySelector('.alert').classList.remove('bg-success');
          document.querySelector('.alert').classList.add('bg-warning');
      } else if (diff === 15) {
          document.querySelector('.alert').classList.remove('bg-warning');
          document.querySelector('.alert').classList.add('bg-danger');
      } else if (diff <= 0) {
          start = Date.now() + 1000;
      }
  };
  // we don't want to wait a full second before the timer starts
  setInterval(() => {
      timer();
      document.onmousemove = () => {
          start = Date.now() + 1000;
          document.querySelector('.timesession').classList.add('hidden');
          document.querySelector('.alert').classList.add('bg-success');
          document.querySelector('.alert').classList.remove('bg-warning');
          document.querySelector('.alert').classList.remove('bg-danger');
      }

      document.onkeydown = () => {
          start = Date.now() + 1000;
          document.querySelector('.timesession').classList.add('hidden');
          document.querySelector('.alert').classList.add('bg-success');
          document.querySelector('.alert').classList.remove('bg-warning');
          document.querySelector('.alert').classList.remove('bg-danger');
      }

      if (diff === 0) {
          window.location = base_url + 'logout';
      }

  }, 1000);

}