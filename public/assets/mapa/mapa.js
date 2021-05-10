(function($, window) {
    $(document).ready(function () {
        $.getJSON('https://mayrcon.ddns.net/frangobomtodo/public/assets/mapa/lojas.json', function (data) {
            var items = [];
            var options = '<option value="">Selecione um bairro</option>';
            $.each(data, function (key, val) {
                options += '<option value="' + val.cidades + '">' + val.cidades + '</option>';
            });
            $("#cidades").html(options);
        });
    });

    jQuery(document).ready(function(){
        jQuery('#pesquisa_loja').submit(function(){
            jQuery.ajax({
                success: function(data) {
                    var loja = jQuery('#cidades').val();

                    if (loja == 'Felipe Camarão') {
                        var localizacao = "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31753.937510644937!2d-35.262814000000006!3d-5.821431!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x226d6443e34a581!2sFrango%20Bom%20Todo%20-%20Guaraves%20Alimentos%20-%20Distribuidora!5e0!3m2!1spt-BR!2sbr!4v1619544749066!5m2!1spt-BR!2sbr";
                        $('#mapa').attr('src', localizacao);
                    } else if (loja == 'Lagoa Nova') {
                        var localizacao = "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31754.238314400925!2d-35.245303!3d-5.816105000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaba84c1474eeb5e1!2sFrango%20Bom%20Todo%20-%20Superatacado%20Bom%20Todo!5e0!3m2!1spt-BR!2sbr!4v1619544905162!5m2!1spt-BR!2sbr";
                        $('#mapa').attr('src', localizacao);
                    } else if (loja == 'Quintas') {
                        var localizacao = "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31754.238314400925!2d-35.245303!3d-5.816105000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5fe9ef769ed5a68e!2sGUARAVES%20GUARABIRA%20AVES%20LTDA!5e0!3m2!1spt-BR!2sbr!4v1619544816908!5m2!1spt-BR!2sbr";
                        $('#mapa').attr('src', localizacao);
                    } else if (loja == 'Nova Parnamirim') {
                        var localizacao = "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31751.611630786847!2d-35.242589!3d-5.86245!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x31875c455fc31f0e!2sFrango%20assado%20Bom%20todo!5e0!3m2!1spt-BR!2sbr!4v1619545539638!5m2!1spt-BR!2sb";
                        $('#mapa').attr('src', localizacao);
                    }
                }
            });
            return false;
        });
    });
})(jQuery, window);
