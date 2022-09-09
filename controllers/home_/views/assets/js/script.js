if (window.innerWidth < 768) {
	$('[data-bss-disabled-mobile]').removeClass('animated').removeAttr('data-aos data-bss-hover-animate');
}

$(document).ready(function(){
	AOS.init();
});

$('.card-sub_notes').addClass('d-none');

var d = new Date();
var day = ("0" + d.getDate()).slice(-2);
var month = ("0" + (d.getMonth() + 1)).slice(-2);

$('#dpkr2').val(d.getFullYear() + "-" + (month) + "-" + (day));
$('#dpkr1').val("1964-09-20");
var message = function (title) {
    chartbioritm.subtitle.textSetter(title);
}

Date.prototype.daysInMonth = function(Year,Month) {
    return 33 - new Date(Year, Month, 33).getDate();
};

function get_bioritm() {
    //var curdata;
    var start = moment($('#dpkr1').val());


   // var start1 = $('#dpkr_1').val() ? moment($('#dpkr_1').val()) : false;
    var curdata = new Date($('#dpkr2').val());
    var daysInMonth = curdata.daysInMonth(curdata.getFullYear(),curdata.getMonth());
    //console.log(daysInMonth);

    var end = moment($('#dpkr2').val());
    
    var passed = end.diff(start, "days");

   // var passed1 = start1 ? end.diff(start1, "days") : false;
    message('пройденно светлых дней 1 ' + passed);
    //console.log(passed1);
    var phys_data = [];
    var emo_data = [];
    var intelect_data = [];
    // var phys_data1 = [];
    // var emo_data1 = [];
    // var intelect_data1 = [];	

    // сборщик gecksogrm_bio
    //физ.	эм.	инт.
    var gecksogrm_bio = {
        "phys_data": 0,
        "emo_data": 0,
        "intelect_data": 0,
    };

    var gecksogrm_dao = {
        "phys_data": 0,
        "emo_data": 0,
        "intelect_data": 0,
    };

    for (i = 0; i < daysInMonth ; i++) {
        if (i === 0) {
            gecksogrm_bio.phys_data = +(Math.sin((2 * Math.PI * (passed + i) / 23)) * 100).toFixed(2) > 0 ? 1 : 0;
            gecksogrm_bio.emo_data = +(Math.sin((2 * Math.PI * (passed + i) / 28)) * 100).toFixed(2) > 0 ? 1 : 0;
            gecksogrm_bio.intelect_data = +(Math.sin((2 * Math.PI * (passed + i) / 33)) * 100).toFixed(2) > 0 ? 1 : 0;

        }
        if (i === (daysInMonth-1)) {
            gecksogrm_dao.phys_data = +(Math.sin((2 * Math.PI * (passed + i) / 23)) * 100).toFixed(2) > 0 ? 1 : 0;
            gecksogrm_dao.emo_data = +(Math.sin((2 * Math.PI * (passed + i) / 28)) * 100).toFixed(2) > 0 ? 1 : 0;
            gecksogrm_dao.intelect_data = +(Math.sin((2 * Math.PI * (passed + i) / 33)) * 100).toFixed(2) > 0 ? 1 : 0;
        }
        phys_data.push(+(Math.sin((2 * Math.PI * (passed + i) / 23)) * 100).toFixed(2));
        emo_data.push(+(Math.sin((2 * Math.PI * (passed + i) / 28)) * 100).toFixed(2));
        intelect_data.push(+(Math.sin((2 * Math.PI * (passed + i) / 33)) * 100).toFixed(2));
        // if(passed1){
        //     phys_data1.push(+(Math.sin((2 * Math.PI * (passed1 + i) / 23)) * 100).toFixed(2));
        //     emo_data1.push(+(Math.sin((2 * Math.PI * (passed1 + i) / 28)) * 100).toFixed(2));
        //     intelect_data1.push(+(Math.sin((2 * Math.PI * (passed1 + i) / 33)) * 100).toFixed(2));		

        // }
    }
    var block_description_bio = document.querySelector("#description-histogram");
    var czy = block_description_bio.querySelector(".czy");
    var blockgeckso = '<div class="d-flex justify-content-around czy-elem">';
    blockgeckso += (gecksogrm_bio.emo_data ? '<span class="span-full" style="background-color:green"></span>' : '<span style="background-color:green"></span><span style="background-color:green"></span>') + "</div>";
    blockgeckso += '<div class="d-flex justify-content-around czy-elem">';
    blockgeckso += (gecksogrm_bio.intelect_data ? '<span class="span-full" style="background-color:blue"></span>' : '<span style="background-color:blue"></span><span style="background-color:blue"></span>') + "</div>";
    blockgeckso += '<div class="d-flex justify-content-around czy-elem">';
    blockgeckso += (gecksogrm_bio.phys_data ? '<span class="span-full" style="background-color:red"></span>' : '<span style="background-color:red"></span><span  style="background-color:red"></span>') + "</div>";
    czy.innerHTML = blockgeckso;
    var blockparagraf = block_description_bio.querySelector("p");
    var blockh3 = block_description_bio.querySelector("h3");
    blockparagraf.innerText = bio.root["z" + gecksogrm_bio.phys_data + gecksogrm_bio.intelect_data + gecksogrm_bio.emo_data ].decription;
    blockh3.innerText = "Данное описание соответствует " + curdata.toLocaleDateString() ;
    var block_description_dao = document.querySelector("#description-gecsogram");
    var blockparagrafdao = block_description_dao.querySelector("p");
    var blockh3dao = block_description_dao.querySelector("h3");
    var line = "z" + gecksogrm_bio.phys_data + gecksogrm_bio.intelect_data + gecksogrm_bio.emo_data  + gecksogrm_dao.phys_data + gecksogrm_dao.intelect_data + gecksogrm_dao.emo_data ;
   //console.log(line);
    blockparagrafdao.innerText = dao.root[line].description;
    blockh3dao.innerText = dao.root[line].title;
    var czyd = block_description_dao.querySelector(".down-elem");
    czyd.innerHTML = blockgeckso;

    var blockgecksodao = '<div class="d-flex justify-content-around czy-elem">';
    blockgecksodao += (gecksogrm_dao.emo_data ? '<span class="span-full" style="background-color:green"></span>' : '<span style="background-color:green"></span><span style="background-color:green"></span>') + "</div>";
    blockgecksodao +='<div class="d-flex justify-content-around czy-elem">';
    blockgecksodao += (gecksogrm_dao.intelect_data ? '<span class="span-full" style="background-color:blue"></span>' : '<span style="background-color:blue"></span><span style="background-color:blue"></span>') + "</div>";
    blockgecksodao +='<div class="d-flex justify-content-around czy-elem">';
    blockgecksodao += (gecksogrm_dao.phys_data ? '<span class="span-full" style="background-color:red"></span>' : '<span style="background-color:red"></span><span  style="background-color:red"></span>') + "</div>";    
    var czyd1 = block_description_dao.querySelector(".up-elem");
    czyd1.innerHTML = blockgecksodao;


    //    console.log( gecksogrm_bio);
    //console.log(Date.UTC(2019, 09, 21));
    //console.log(moment.utc());

    chartbioritm.series[0].update({
        pointStart: moment.utc(curdata).valueOf()//Date.UTC(2019, 09, 21)//curdata
    });
    chartbioritm.series[0].setData(phys_data);

    chartbioritm.series[1].update({
        pointStart: moment.utc(curdata).valueOf()//Date.UTC(2019, 09, 21)//curdata
    });
    chartbioritm.series[1].setData(emo_data);

    chartbioritm.series[2].update({
        pointStart: moment.utc(curdata).valueOf()//Date.UTC(2019, 09, 21)//curdata
    });
    chartbioritm.series[2].setData(intelect_data);
    /////////////////////////////////////////////////////	

    // chartbioritm.series[3].update({
    //     pointStart: moment.utc(curdata).valueOf()//Date.UTC(2019, 09, 21)//curdata
    // });
    // chartbioritm.series[3].setData(phys_data1);

    // chartbioritm.series[4].update({
    //     pointStart: moment.utc(curdata).valueOf()//Date.UTC(2019, 09, 21)//curdata
    // });
    // chartbioritm.series[4].setData(emo_data1);

    // chartbioritm.series[5].update({
    //     pointStart: moment.utc(curdata).valueOf()//Date.UTC(2019, 09, 21)//curdata
    // });
    // chartbioritm.series[5].setData(intelect_data1);	



}


var chartbioritm = Highcharts.chart('bioritmnew', {

    chart: {
        type: 'spline',
    },
    colors: ['#ff5500', '#22d21e', '#5a8ce6', '#f737a1', '#4fe097', '#6637f7'],
    title: {
        text: 'Расчетный график биоритмов'
    },
    subtitle: {
        text: 'Вы прожили - 19810 дней'
    },
    lang: {
        loading: 'Загрузка...',
        months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        weekdays: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
        shortMonths: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
        exportButtonTitle: "Экспорт",
        printButtonTitle: "Печать",
        rangeSelectorFrom: "С",
        rangeSelectorTo: "По",
        rangeSelectorZoom: "Период",
    },
    xAxis: {
        labels: {
            style: {
                fontSize: '9px'
            }
        },
        type: 'datetime',
        tickInterval: 24 * 3600 * 1000,
        title: {
            text: 'Дата'
        },
    },
    yAxis: {
        plotLines: [{
            value: 0,
            color: '#808080',
            width: 2,
            zIndex: 4
        }
        ],
        title: {
            text: 'Шкала в процентах (%)'
        },
        labels: {
            formatter: function () {
                return this.value + '%';
            }
        }
    },
    tooltip: {
        valueSuffix: '%',
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    exporting: {
        sourceWidth: 1400
    },
    series: [{
        name: 'Физический биоритм',
        pointInterval: 24 * 3600 * 1000,
        pointStart: Date.UTC(2019, 08, 21),
        marker: {
            symbol: 'diamond',
            radius: 1
        },
        data: [],
    }, {
        name: 'Эмоциональный биоритм',
        pointInterval: 24 * 3600 * 1000,
        pointStart: Date.UTC(2019, 08, 21),
        marker: {
            symbol: 'diamond',
            radius: 1
        },
        data: []
    }, {
        name: 'Интеллектуальный биоритм',
        pointInterval: 24 * 3600 * 1000,
        pointStart: Date.UTC(2019, 08, 21),
        marker: {
            symbol: 'diamond',
            radius: 1
        },
        data: []
    }
    ]
});