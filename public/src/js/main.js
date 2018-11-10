
var $doc = $('html, body');

$(document).ready(function () 
{
    // Scroll suave - para que ao clicar para algum link da propria pagina se torne suave sua rolagem
    window.onscroll = function() {revelaBtn()};

    $("btn-rolar-para-cima").hide();
    $(".scrollSuave").click(function () {
        $doc.animate({
            scrollTop:  $($.attr(this, 'href')).offset().top
        }, 1000);
        return false;
    });

    function revelaBtn() 
    {

        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
        {
            $("#btn-rolar-para-cima").fadeIn(800);
        } else {
            $("#btn-rolar-para-cima").fadeOut(500);
        }
    }

    //Sidebar para que o menu de consulta se torne retratil
    $('#sideCollapse').click(function () 
    {
        $('#sidebar').toggleClass('active');
        $('#sideCollapse').fadeOut(500);
    });

    $('#hideConsultar').click(function ()
    {
        $('#sidebar').removeClass('active');
        $('#sidebar').toggleClass('disabled');
        $('#sideCollapse').fadeIn(500);
    });

    //Simula uma busca
    $('#btnBuscar').click(function ()
     {
        event.preventDefault();
        $('#content').fadeTo('fast', 1, 'linear');

        // Esconde sidebar buscar
        $('#sidebar').removeClass('active');
        $('#sidebar').toggleClass('disabled');


    });

    //Remove class Container caso a tela fique menor que 768
    var tela = $(window).width();
    if (tela < 768) 
    {
        $('#content').removeClass('container');

        $('#btn-detalhes').removeClass('float-right');

        //Simula uma busca
        $('#btnBuscar').click(function () 
        {
            event.preventDefault();
            $('#sideCollapse').fadeIn(500);
        });

    }



})
