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
    /**
     * раскрытие закрытие группировок
     */
    var groups = document.querySelectorAll('.group');
    if(groups){
        for(var i = 0; i< groups.length;i++){
            groups[i].addEventListener('click',function(e){
                    e.preventDefault();
                    e.stopPropagation();
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
    var descriptions = document.querySelectorAll('.element-item');
    if(descriptions){
        for(var i = 0; i< descriptions.length;i++){
            descriptions[i].addEventListener('click',function(e){
                e.preventDefault();
                e.stopPropagation();
                this.querySelector('.item-description').classList.toggle("show");
            })

        }
    }
}
