var bg = {
    success:'#dbfad7',
    default:'#faebd7',
    error:'#ffd6ce'
};
// modal windows
var modalAddItem = '';
var modalupdateItem = "";
var modalremoveItem = "";
var modalAlert = '';
// /modal windows

document.addEventListener('DOMContentLoaded',init);

function init(){
    modalAddItem = document.getElementById('modalAddItem'); // форма добавления элемента
    modalupdateItem = document.getElementById('modalupdateItem'); // форма обновления элемента
    modalremoveItem = document.getElementById('modalremoveItem'); // форма удаления элемента можно сделать в одной но не стал
    modalAlert = document.getElementById('modalAlert');

    
    /** это для работы с ajax убрал */
    //submits = document.querySelectorAll("form");
    //rootPoint = document.getElementById('rootUl');
    //element_list_node = document.querySelector('#element_list_node');

    /**
     * раскрытие закрытие группировок
     */
    var groups = document.querySelectorAll('.group');
    if(groups){
        for(var i = 0; i< groups.length;i++){
            groups[i].addEventListener('click',function(e){
                    e.preventDefault();
                    var that = this;
                    that.classList.toggle("up");
                    if(that.classList.contains("up")){
                        that.closest('li').querySelector('.childs').style.opacity= 0;
                        setTimeout(function(){
                            that.closest('li').querySelector('.childs').style.display = "none";
                        },500);
                    } else {
                        that.closest('li').querySelector('.childs').style.opacity = 1;
                        setTimeout(function(){
                            that.closest('li').querySelector('.childs').style.display = "block";
                        },500);

                    }
            });
        }
    }

    document.getElementById('newblock').addEventListener('click',function(e){
        e.preventDefault();
        modalAddItem.querySelector('[name="tree_key"]').value = 0;
        modalAddItem.querySelector('[name="id"]').value = '';
        modalAddItem.classList.add('show');
    }); 

    // if (submits) {
    //     for (var i = 0; i < submits.length; i++) {
    //         eventSubmit(submits[i]);
    //     }
    
    // }
 
    /**
     * отменяем модальное окно и сбрасываем данные формы
     */
    var resets = document.querySelectorAll('form .reset');
    if (resets) {
        for (var i = 0; i < resets.length; i++) {
            eventReset(resets[i]);
        }
    }

    /** запускаем и заполняем модальное окно для добавления элементов */
    var actionadditems = document.querySelectorAll('.addItem');
    if (actionadditems) {
        for (var i = 0; i < actionadditems.length; i++) {
            evenAddItem(actionadditems[i]);
        }
    
    }

    /** Обновление записи */
    var actionUpdataItems = document.querySelectorAll('.editItem');
    if (actionUpdataItems) {
        for (var i = 0; i < actionUpdataItems.length; i++) {
            evenUpdateItem(actionUpdataItems[i]);
        }
    
    }
    /** удаление записей */
    var actionReveItems = document.querySelectorAll('.removeItem');
    if (actionReveItems) {
        for (var i = 0; i < actionReveItems.length; i++) {
            evenRemoveItem(actionReveItems[i]);
        }
    
    }
}



/** показ сообщения */
function modalalert(data, bgcolor) {
    modalAlert.querySelector('p').innerHTML = data;
    modalAlert.style.backgroundColor = bg[bgcolor];
    modalAlert.classList.add('show');
    setTimeout(function () {
        modalAlert.style.backgroundColor = bg.default;
        modalAlert.classList.remove('show');
    }, 5000);
}


/**  отменяем показ и возможно сбрасываем форму */
function eventReset(item) {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        var that = this;
        var blockmodal = that.closest('.modal');

        blockmodal.classList.remove('show');
    });

}

/** выбор родителя для добавления в узел */
function evenAddItem(item) {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        var that = this;
        var rootElementli = that.closest('li'); 
        modalAddItem.querySelector('[name="tree_key"]').value = rootElementli.dataset.tree_key;
        modalAddItem.querySelector('[name="id"]').value = rootElementli.dataset.id;
        modalAddItem.classList.add('show');
    });
}

function evenUpdateItem(item){
    item.addEventListener('click', function (e) {
        e.preventDefault();
        var that = this;
        var rootElementli = that.closest('li'); 
        modalupdateItem.querySelector('[name="tree_key"]').value = rootElementli.dataset.tree_key;
        modalupdateItem.querySelector('[name="id"]').value = rootElementli.dataset.id;
        modalupdateItem.querySelector('[name="name"]').value = rootElementli.querySelector('.item-title').innerText;
        modalupdateItem.querySelector('[name="description"]').value = rootElementli.dataset.description;
        modalupdateItem.classList.add('show');
    });
}

function evenRemoveItem(item){
    item.addEventListener('click', function (e) {
        e.preventDefault();
        var that = this;
        var rootElementli = that.closest('li'); 
        modalremoveItem.querySelector('[name="tree_key"]').value = rootElementli.dataset.tree_key;
        modalremoveItem.querySelector('[name="id"]').value = rootElementli.dataset.id;
        modalremoveItem.querySelector('[name="name"]').value = rootElementli.querySelector('.item-title').innerText;
        modalremoveItem.querySelector('[name="description"]').value = rootElementli.dataset.description;
        modalremoveItem.classList.add('show');
    });

}
/*** добавляем элемент убрал для работы с ajax*/
// function requestAddItem(data) {
//     if (data.indexOf('}') == -1) {
//         modalalert(data, bgerror);
//     } else {
//         var result = JSON.parse(data);

//         if (result.status === 'success') {
//             message = result.message + "<br>";
//             message += 'id: ' + result.data.id + "<br>";
//             message += 'tree_key: ' + result.data.tree_key + "<br>";
//             message += 'name: ' + result.data.name + "<br>";
//             message += 'description: ' + result.data.description + "<br>";


//             var clone = element_list_node.content.cloneNode(true); 
//             var itemLi = clone.querySelector("li");
//             itemLi.dataset.id = result.data.id;
//             itemLi.dataset.tree_key = result.data.tree_key;
//             itemLi.dataset.description = result.data.description;
//             clone.querySelector(".item-title").innerText = result.data.name;
//             evenAddItem(clone.querySelector(".addItem"));             
//             rootPoint.appendChild(clone);     
   
//             //происходит добавление в узел и отсылаем алерт

//             modalalert(message, bgsuccess);
//         }
//     }
// }

// function eventSubmit(item) {
//     item.addEventListener('submit', function (e) {
//         e.preventDefault();
//         var that = this;
//         var blockmodal = that.closest('.modal');
//         var cur_form = blockmodal.querySelector('form');
//         var url = cur_form.action;
//         var data = {
//             name: cur_form.elements.name.value,
//             description: cur_form.elements.description.value,
//             tree_key: cur_form.querySelector('[name="tree_key"]').value,
//             id: cur_form.querySelector('[name="id"]').value,
//         };
//         sendData(url, data, 'requestAddItem');

//         blockmodal.classList.remove('show');
//     });
// }
/** отправка ajax убрал в этой реализации упростил код */
// function sendData(url, data, customfunction) {
//     const XHR = new XMLHttpRequest(),
//         FD = new FormData();

//     // Push our data into our FormData object
//     for (name in data) {
//         FD.append(name, data[name]);
//     }

//     // Define what happens on successful data submission
//     XHR.addEventListener('load', function (event) {
//         if (window[customfunction]) {
//             window[customfunction](XHR.response);
//         }
//     });

//     // Define what happens in case of error
//     XHR.addEventListener(' error', function (event) {
//         errorMessage(XHR.response);
//     });

//     // Set up our request
//     XHR.open('POST', url);

//     // Send our FormData object; HTTP headers are set automatically
//     XHR.send(FD);
// }

// function errorMessage(response) {
//     console.log(respons);
// }