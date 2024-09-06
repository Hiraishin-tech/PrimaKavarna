$("#stranky").sortable({
    update: () => {
        // alert("Došlo ke změně pořadí stránek");
        const zmenaPoradiStranek = $("#stranky" ).sortable( "toArray" );
        // console.log(zmenaPoradiStranek);

        $.ajax({
            url: "admin.php",
            method: "POST",     // defaultně je metoda GET
            data: {
                "poradi" : zmenaPoradiStranek,
            }
        });
    }
});

$("#stranky .smazat").click((udalost) => {      // selector na smazání stránky
    if (confirm("Opravdu chcete stránku smazat?") == false) {
        udalost.preventDefault();
    }
});