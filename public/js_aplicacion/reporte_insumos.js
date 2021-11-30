const inicializarGraficaInsumosCantidadPastel = (data) => {
    let valores = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        var tmp = {
            name: data[index].codigo,
            selected: (Number(index) === 1 ? true : false),
            y: parseInt(data[index].cantidad)
        };
        valores.push(tmp);
    }

    Highcharts.chart('containerCantidadInsumosPastel', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Cantidad por insumos'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Cantidad',
            data: valores
        }]
    });
};

const inicializarGraficaInsumosCantidadBarra = (data)  => {

    let valores = [];
    let categoria = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        valores.push(Number(data[index].cantidad));
        categoria.push("<b>"+data[index].codigo+"</b>");
    }

    Highcharts.chart('containerCantidadInsumosBarra', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Cantidad por insumos'
        },
        subtitle: {
            text: 'Cantidad en almacén por insumos'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: categoria,
            title: {
                text: null
            }
        },
        yAxis: {
            title: {
                text: '<b>Total</b>'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}"><b>{point.y}</b><br/>'
        },

        series: [
            {
                name: "Cantidad por insumos",
                colorByPoint: true,
                data: valores
            }
        ]
    });

};

const inicializarGraficaInsumosTiposPastel = (data) => {
    let valores = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        var tmp = {
            name: data[index].tipo_producto,
            selected: (Number(index) === 1 ? true : false),
            y: parseInt(data[index].cantidad)
        };
        valores.push(tmp);
    }

    Highcharts.chart('containerTipoInsumosPastel', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Insumos por tipo de producto'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Cantidad',
            data: valores
        }]
    });
};

const inicializarGraficaInsumosTiposBarra = (data)  => {

    let valores = [];
    let categoria = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        valores.push(Number(data[index].cantidad));
        categoria.push("<b>"+data[index].tipo_producto+"</b>");
    }

    Highcharts.chart('containerTipoInsumosBarra', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Insumos por tipo de producto'
        },
        subtitle: {
            text: 'Total de insumos registrados por tipo de producto'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: categoria,
            title: {
                text: null
            }
        },
        yAxis: {
            title: {
                text: '<b>Total</b>'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}"><b>{point.y}</b><br/>'
        },

        series: [
            {
                name: 'Insumos por tipo de producto',
                colorByPoint: true,
                data: valores
            }
        ]
    });

};

const consultarInsumosCantidad = async () => {
    $.ajax({
        url: "/consultarInsumos",
        method: "GET",
        data: "",
    })
        .done(function (res) {
            inicializarGraficaInsumosCantidadPastel(res.cantidad_insumos);
            inicializarGraficaInsumosCantidadBarra(res.cantidad_insumos);
            inicializarGraficaInsumosTiposPastel(res.tipos_insumos);
            inicializarGraficaInsumosTiposBarra(res.tipos_insumos);
        })
        .fail(function (res) {
            console.log(res);
            swal(
                {
                    type: "error",
                    title: "Error",
                    text: "Ha ocurrido un error.",
                    confirmButtonText: "OK",
                },
                function () {
                    location.href = "/insumos";
                }
            );
        });
};

const convertirSVGaPNG = (svg, callback) => {
    const url = getSvgUrl(svg);
    constructor.svgUrlToPng(url, (imgData) => {
        callback(imgData);
        URL.revokeObjectURL(url);
    });
};

const getSvgUrl = (svg) => {
    return  URL.createObjectURL(new Blob([svg], {type: 'image/svg+xml'}));
};

const svgUrlToPng = (svgUrl, callback) => {
    const svgImage = document.createElement('img');

    svgImage.id = "imageExport";
    document.body.appendChild(svgImage);
    svgImage.onload = function () {
        const canvas = document.createElement('canvas');
        canvas.width = svgImage.clientWidth;
        canvas.height = svgImage.clientHeight;
        const canvasCtx = canvas.getContext('2d');
        canvasCtx.drawImage(svgImage, 0, 0);
        const imgData = canvas.toDataURL('image/png');
        callback(imgData);
        // document.body.removeChild(imgPreview);
    };
    svgImage.src = svgUrl;
};

$(document).ready(e => {
    consultarInsumosCantidad();
});