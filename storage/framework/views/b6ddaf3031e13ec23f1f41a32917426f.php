<?php
use Illuminate\Support\Facades\DB;
   $categories = DB::table('categories')->get();
?>
<style>
    .form {
  outline: 0;
  float: left;

  -webkit-border-radius: 10px;
  border-radius: 10px;
}

.form > .textbox {
  outline: 0;
  height: 42px;
  width: 400px;
  line-height: 42px;
  padding: 0 16px;
  background-color: rgba(255, 255, 255, 0.8);
  color: #212121;
  border: 0.8px solid #D9EAFD;
float:left;
  -webkit-border-radius: 10px 0 0 10px;
  border-radius: 10px 0 0 10px;
  
}

.form > .textbox:focus {
  outline: 0;
  background-color: #FFF;
}

.form > .button {
  outline: 0;
  background: none;
  background-color: #1F3E39;
  float: left;
  height: 42px;
  width: 42px;
  text-align: center;
  line-height: 42px;
  border: 0;
  color: #FFF;
  font: normal normal normal 14px/1 FontAwesome;
  font-size: 16px;
  text-rendering: auto;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
  -webkit-transition: background-color .4s ease;
  transition: background-color .4s ease;
  -webkit-border-radius: 0 4px 4px 0;
  border-radius: 0 4px 4px 0;
}

.form > .button:hover {
  background-color: rgba(0, 150, 136, 0.8);
}

.navigations {
	list-style: none;
	margin: 0;
	background-color: #93BD93;
	border-top: 1px solid #93BD93;
	display: -webkit-box;
	display: -moz-box;
	display: -ms-flexbox;
	display: -webkit-flex;

	display: flex;
	-webkit-flex-flow: row wrap;

}


.navigations a {
	text-decoration: none;
	display: block;
	padding: 1em;
	color: #1F3E39;
}

.navigations a:hover {
	background: #1F3E39;
	color:white;
}

@media all and (max-width: 800px) {
	.navigation {
		justify-content: space-around;
	}
	.form > .textbox {

  max-width: 400px;

}
.search-with-any-texts{
  padding-top:20px;  
}
}
@media all and (max-width: 750px) {

	.form > .textbox {

  max-width: 350px;

}
}
@media all and (max-width: 600px) {
	.navigations {
		-webkit-flex-flow: column wrap;
		flex-flow: column wrap;
		padding: 0;
	}
	.form > .textbox {

  max-width: 300px;

}
	.navigations a {
		text-align: center;
		padding: 10px;
		border-top: 1px solid rgba(255, 255, 255, 0.3);
		border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		
	}

	.navigations li:last-of-type a {
		border-bottom: none;
	}
}





.navigation {
  position: relative;
  background:#EEF7FF;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
}
.navigation:not(.--jsfied) {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}
.navigation .nav__hidden {
  display: none;
}
.navigation .nav__list {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}
.navigation .nav__list li {
  transition: 0.25s;
}
.navigation .nav__list > li {
  flex-grow: 1;
}
.navigation .nav__list > li > a {
  padding: 1em;
  white-space: nowrap;
  
}
.navigation .nav__list > li a {
  color: #000;
  transition: 0.25s;
  	text-decoration: none;
  	font-size:15px;
	color: #017783;
}
.navigation .nav__list > li a:hover {
 	background: #017783;
	color:white;
}
.navigation .nav__list .nav__item__more button {
  padding: 15px;
  white-space: nowrap;
  border: 0;
  background: transparent;
  cursor: pointer;
}
.navigation .nav__list .nav__item__more svg {
  width: 20px;
  height: 20px;
  transition: 0.25s;
}
.navigation.nav__active .nav__list .nav__item__more svg {
  transform: rotate(90deg);
}
.navigation .nav__list__more {
  list-style: none;
  position: absolute;
  top: calc(100% + 5px);
  right: 100px;
  z-index:9;
  background:#EEF7FF;
  display: none;
  max-width: 100%;
  min-width: 10em;
  margin: 0;
  padding: 5px 0;
  border-radius: 5px;
 box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
-webkit-animation: nav-dropdown-animation 0.2s;
animation: nav-dropdown-animation 0.2s;

}
.navigation .nav__list__more li {
  padding: 10px 15px;
}
.navigation.nav__active .nav__list__more {
  display: block;
}

@-webkit-keyframes nav-dropdown-animation {
  0% {
    opacity: 0;
    transform: translateY(-1em);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes nav-dropdown-animation {
  0% {
    opacity: 0;
    transform: translateY(-1em);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}


#all_search_result {
  position: absolute;
  top: 100%; /* Place les résultats directement sous l'input */
  left: 0;
  right: 0;
  background: white; /* Assurez-vous que les résultats soient visibles */
  border: 1px solid #ddd;
  border-top: none;
  z-index: 1000; /* Place le conteneur au-dessus des autres éléments */
  min-height: 150px;
  height:auto;
  max-height:600px;
  overflow-y: auto; /* Permet le défilement si les résultats dépassent */
  display: none; /* Cache par défaut */
}

#all_search_result.active {
  display: block; /* Affiche les résultats quand ils sont disponibles */
}
#all_search_result::-webkit-scrollbar {
  width: 8px; /* Largeur de la barre de défilement */
}

#all_search_result::-webkit-scrollbar-track {
  background: #f1f1f1; /* Couleur de l'arrière-plan de la barre */
  border-radius: 20px;
}

#all_search_result::-webkit-scrollbar-thumb {
  background: #017783; /* Couleur de la barre de défilement */
  border-radius: 20px; /* Bord arrondi */
}

#all_search_result::-webkit-scrollbar-thumb:hover {
  background: #017783; /* Couleur plus foncée au survol */
}

/* Style pour les navigateurs supportant scrollbar (non-webkit) */
#all_search_result {
  scrollbar-width: thin; /* Taille fine pour Firefox */
  scrollbar-color: #017783 #f1f1f1; /* Couleur de la barre et du fond */
}

.search_with_text_section div {
  padding: 10px;
}

.suggestion-items:hover {
  background-color: #f5f5f5;
}


</style>
<header class="header-style-01">
    <nav class="navbar navbar-area headerBg4 navbar-expand-lg plr">
        <div class="container-fluid container-1920 container-two nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="<?php echo e(route('homepage')); ?>" class="logo">
                        <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?> 
                    </a>
                </div>
                <?php echo $__env->make('frontend.layout.partials.navbar-variant.mobile-responsive-icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="NavWrapper">
               
                <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                    <!-- Main Menu
                    <ul class="navbar-nav">
                        <?php echo render_frontend_menu($primary_menu); ?>

                    </ul> -->
                     <div class="search-with-any-texts">  
                 <form  action="<?php echo e('/listings'); ?>" class="form" method="get">
  <input type="text" class="textbox" name="home_search" id="home_search" placeholder="Rechercher une annonce"> 
 
  <input title="Search" value="" type="submit" class="button">
  <div id="all_search_result"  class="search_with_text_section"> </div>
</form>
                </div>
                </div>
               
            </div>
            <!-- Menu Right -->
            <div class="nav-right-content">
              <?php echo $__env->make('frontend.layout.partials.navbar-variant.user-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </nav> 
  
   	<div class="wrapper">
   	 <nav class="navigation">
    <ul class="nav__list">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li class="nav__item"><a class="nav__list" href="https://www.tutrouve.com/listing/category/<?php echo e($cat->slug); ?>" >
    <i class="<?php echo e($cat->icon); ?>" style=" vertical-align:middle; font-size:20px; margin-left:5px;"></i>
    <span style="margin-left:5px;"><?php echo e($cat->name); ?></span>
</a></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
    </ul>
  </nav></div>
  <script>
      // Script
const container = document.querySelector(".navigation");
const primary = container.querySelector(".nav__list");
const primaryItems = container.querySelectorAll(
  ".nav__list > li:not(.nav__item__more)"
);
container.classList.add("--jsfied");

// insert "more" button and duplicate the list
primary.insertAdjacentHTML(
  "beforeend",
  `
  <li class="nav__item__more">
    <button type="button" aria-haspopup="true" aria-expanded="false">
      <svg id="fi_3018442" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="2"></circle><circle cx="4" cy="12" r="2"></circle><circle cx="20" cy="12" r="2"></circle></svg>
    </button>
    <ul class="nav__list__more">
      ${primary.innerHTML}
    </ul>
  </li>
`
);

const secondary = container.querySelector(".nav__list__more");
const secondaryItems = secondary.querySelectorAll("li");
const allItems = container.querySelectorAll("li");
const moreLi = primary.querySelector(".nav__item__more");
const moreBtn = moreLi.querySelector("button");

moreBtn.addEventListener("click", (e) => {
  e.preventDefault();
  container.classList.toggle("nav__active");
  moreBtn.setAttribute(
    "aria-expanded",
    container.classList.contains("nav__active")
  );
});

// adapt tabs
const doAdapt = () => {
  // reveal all ite  ms for the calculation
  allItems.forEach((item) => {
    item.classList.remove("nav__hidden");
  });

  // hide items that won't fit in the Primary
  let stopWidth = moreBtn.offsetWidth;
  let hiddenItems = [];
  const primaryWidth = primary.offsetWidth;
  primaryItems.forEach((item, i) => {
    if (primaryWidth >= stopWidth + item.offsetWidth) {
      stopWidth += item.offsetWidth;
    } else {
      item.classList.add("nav__hidden");
      hiddenItems.push(i);
    }
  });

  // toggle the visibility of More button and items in Secondary
  if (!hiddenItems.length) {
    moreLi.classList.add("nav__hidden");
    container.classList.remove("nav__active");
    moreBtn.setAttribute("aria-expanded", false);
  } else {
    secondaryItems.forEach((item, i) => {
      if (!hiddenItems.includes(i)) {
        item.classList.add("nav__hidden");
      }
    });
  }
};

doAdapt(); // adapt immediately on load
window.addEventListener("resize", doAdapt); // adapt on window resize

// hide Secondary on the outside click

document.addEventListener("click", (e) => {
  let el = e.target;
  while (el) {
    if (el === secondary || el === moreBtn) {
      return;
    }
    el = el.parentNode;
  }
  container.classList.remove("nav__active");
  moreBtn.setAttribute("aria-expanded", false);
});
console.log("f");
  </script>
</header>

<?php /**PATH /home/tutreqhl/public_html/core/resources/views/frontend/layout/partials/navbar-variant/navbar-01.blade.php ENDPATH**/ ?>