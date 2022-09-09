<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="/notes"><img src="/assets/images/biznes.png" width="30" height="30" alt=""></a>

    <button class="navbar-toggler d-sm-none" type="button" data-toggle="collapse" data-target="#navbarSearchContent" aria-controls="navbarSearchContent" aria-expanded="false" aria-label="search navigation">
	<i class="fa fa-search"></i>
    </button>
    <button class="navbar-toggler d-sm-none" type="button" data-toggle="collapse" data-target="#navbarProfileContent" aria-controls="navbarProfileContent" aria-expanded="false" aria-label="turning navigation">
	<i class="fa fa-dharmachakra"></i>
    </button>



    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="nav mr-auto">
	    <li class="nav-item ">
		<a class="nav-link " id="news-tab" data-toggle="tab" href="#news"  >Новости </a>
	    </li>
	    <li class="nav-item">
		<a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes">Разделы</a>
	    </li>
	    <li class="nav-item">
		<a class="nav-link" id="content-tab" data-toggle="tab" href="#content">Профиль</a>
	    </li>
		<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Программы
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/service">Сервис</a>
          <a class="dropdown-item" href="/budget">Бюджет</a>
		  <a class="dropdown-item" href="/notes/node/89">Биоритмы</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Биоритмы</a>
        </div>
      </li>
	</ul>
	<div class="btn-group btn-group-sm mr-auto d-none" id="btns-edit" >


	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" type="button" onclick="contentEdit()"><i class="fa fa-edit"></i></button> 

	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary bellsContent" type="button" ><i class="fa fa-bell"></i></button>
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary btnTimeLines" type="button" ><i class="far fa-chart-bar"></i></button>		
        <button class="d-none d-sm-block btn btn-sm btn-outline-secondary " type="button" onclick="insertTag('php')"><i class="fa fa-closed-captioning"></i></button>
        <button class="d-none d-sm-block btn btn-sm btn-outline-secondary " type="button" onclick="insertTag('broom')" title="очистить от HTML tag"><i class="fa fa-broom"></i></button>
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" type="button" onclick="InsertTagHtml();"><i class="fa fa-share"></i></button>
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" type="button" onclick="format__console();"><i class="fa fa-hashtag"></i></button>		
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" title="Выделить" type="button" onclick="insertTag('check')"><i class="fa fa-check  text-success"></i></button>
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" title="Дата" type="button" onclick="insertTag('Date')"><i class="fa fa-clock  "></i></button>		
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" title="Выделить" type="button" onclick="insertTag('Bold')"><i class="fa fa-bold"></i></button>
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" type="button" onclick="tagAchor();"><i class="fa fa-bookmark"></i></button>
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" type="button" onclick="showHtml()"><i class="fa fa-code"></i>

	    </button>
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" type="button" onclick="savecontent()"><i class="fa fa-save"></i></button>
	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" type="button" onclick="printDoc()"><i class="fa fa-print"></i></button>

	    <button class="d-none d-sm-block btn btn-sm btn-outline-secondary" title="Наверх товарищи" type="button" onclick="upscroll()"><i class="fa fa-angle-double-up"></i></button>
	</div>
	<form class="form-inline my-lg-0 d-none d-sm-block">
	    <input class="form-control form-control-sm my-2 mr-sm-2"  name="notesearch" placeholder="Search" aria-label="Search">
	    <button class="btn btn-sm btn-outline-success my-2 my-sm-0 search_notes" >Search</button>
	</form>
    </div>


    <div class="collapse navbar-collapse" id="navbarSearchContent">
	<form class=" d-sm-none">
	    <div class="input-group">
		<input class="form-control form-control-sm my-2" name="notesearch"  placeholder="Search" aria-label="Search">
		<div class="input-group-append">
		    <button class="btn btn-sm btn-outline-success my-2 search_notes" >Search</button>
		</div>
	    </div>
	</form>
    </div>
    <div class="collapse navbar-collapse" id="navbarProfileContent">
	<div class="d-sm-none">
	    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="contentEdit()"><i class="fa fa-edit"></i></button>
	    <button class="btn btn-sm btn-outline-secondary bellsContent" type="button" ><i class="fa fa-bell"></i></button>
	    <button class=" btn btn-sm btn-outline-secondary" type="button" onclick="savecontent()"><i class="fa fa-save"></i></button>
	    <button class=" btn btn-sm btn-outline-secondary" type="button" onclick="printDoc()"><i class="fa fa-print"></i></button>
	</div>
    </div>

</nav>

<!-- Sidebar  -->
<nav id="sbbells" class="left-side-bar">
    <button type="button" class="close mb-4" aria-label="Close">
	<span aria-hidden="true">&times;</span>
    </button>
    <p>Линия события</p>
    <form id="notes_bell">
	<div class="form-group">
	    <label for="time_r">Начало события</label>
	    <input type="datetime-local" class="form-control form-control-sm time_r" id="time_r" >
	</div>
	<div class="form-group">
	    <label for="time_e">Завершение события</label>
	    <input type="datetime-local" class="form-control form-control-sm time_e" id="time_e" >
	</div>

	<div class="form-group form-check">
	    <input type="checkbox" class="form-check-input" id="tline">
	    <label class="form-check-label" for="tline">TimeLine</label>
	</div>


	<div class="form-group form-check">
	    <input type="checkbox" class="form-check-input" id="status">
	    <label class="form-check-label" for="status">Завершено</label>
	</div>
       
        <div class="form-group__img">
        <img id="navbar_icon_img" class="content_icon_img" src="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAD///8A////AHx8fINcXFyj////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wCqqqpUBgYG+Ozs7BLW1tYonJycYoKCgnyMjIxxrq6uUOjo6BX///8A////AP///wD///8A////AP///wD///8A3t7eH2ZmZpkkJCTbICAg3tLS0ivS0tIrICAg3hISEu1GRka5UFBQrra2tkj///8A////AP///wD///8A8PDwDlpaWqWSkpJrenp6hR4eHuC+vr4/vr6+PxoaGuXKysoz////AKSkpFoAAAD/VlZWqPr6+gP///8A////AEhISLZOTk6x/Pz8Ae7u7g8UFBTqAAAA/wAAAP8AAAD/MDAwz3Jyco02NjbJSEhItg4ODvCEhIR5////AP///wACAgL9AAAA/xQUFOoKCgr1AAAA/wAAAP8AAAD/AAAA/wAAAP8AAAD/wsLCPP///wCurq5QHBwc4////wD///8AwsLCPIiIiHVWVlaoAgIC/QAAAP8AAAD/AAAA/wAAAP8AAAD/AAAA/ygoKNdubm6RIiIi3QAAAP////8A////AP///wD///8A+Pj4BigoKNcAAAD/AAAA/wAAAP8AAAD/AAAA/wAAAP9iYmKcysrKM2JiYpwUFBTq////AP///wD///8AioqKdBgYGOdOTk6xWFhYp4iIiHUoKCjXAAAA/wAAAP8AAAD/hoaGePr6+gOIiIh1ampqlP///wD///8A////ABAQEO4AAAD/zMzMMiAgIN5+fn6BkJCQbgAAAP8AAAD/AAAA/wAAAP8AAAD/GBgY5+jo6BX///8A////AP///wC6urpEFhYW6RQUFOp+fn6BGhoa5RwcHOMAAAD/AAAA/wAAAP8AAAD/JiYm2dbW1ij///8A////AP///wD///8A////APLy8gyKiop0ZGRkmxwcHONAQEC/AAAA/wwMDPNAQEC/mpqaZPj4+Ab///8A////AP///wD///8A////AP///wD///8A////AP///wBsbGyTtra2SPDw8A7///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8Afn5+gQQEBPqmpqZX////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AKCgoF4GBgb4SkpKtf///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wDCwsI8QkJCvVBQUK7///8A////AP///wD///8A////AP///wD///8Az/8AAO//AADjDwAA03MAAJgDAACAHQAA4AEAAPAJAADiHQAAyQMAAOAHAAD4HwAA/f8AAPz/AAD+fwAA/n8AAA==" alt=""> 
        </div>
       <div class="form-group">
	    <label for="logoicon">Logoicon base64</label>
            <textarea class="form-control form-control-sm" name="icon" id="logoicon" ></textarea>
	</div>


	<button onclick="return add_notes_bell()" class="btn btn-sm btn-primary">Сохранить</button>
    </form>
</nav>

<!-- Sidebar  -->
<nav id="sbtimeline" class="left-side-bar">
    <button type="button" class="close mb-4" aria-label="Close">
	<span aria-hidden="true">&times;</span>
    </button>
    <p>Линия события</p>
    <div id="chartTimeLine" style="height: 80vh;"></div>
</nav>





<div class="overlay"></div>
