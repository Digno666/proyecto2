<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Inertia\Inertia;

class ConsumirServicioController extends Controller
{
    public function RecolectarDatos(Request $request)
{
    try {
        $lcComerceID = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
        $lnMoneda = 2;
        $lnTelefono = $request->tnTelefono;
        $lcNombreUsuario = $request->tcRazonSocial;
        $lnCiNit = $request->tcCiNit;
        $lnMontoClienteEmpresa = $request->tnMonto;
        $lcCorreo = $request->tcCorreo;
        $lcUrlCallBack = "http://localhost:8000/";
        $lcUrlReturn = "http://localhost:8000/";
        $laPedidoDetalle = $request->taPedidoDetalle;
        $lcUrl = "";

        $loClient = new Client();

        if ($request->tnTipoServicio == 1) {
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";
        } elseif ($request->tnTipoServicio == 2) {
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/realizarpagotigomoneyv2";
        }

        $laHeader = [
            'Accept' => 'application/json'
        ];

        $laBody = [
            "tcCommerceID" => $lcComerceID,
            "tnMoneda" => $lnMoneda,
            "tnTelefono" => $lnTelefono,
            'tcNombreUsuario' => $lcNombreUsuario,
            'tnCiNit' => $lnCiNit,
            'tcNroPago' => "UAGRM-CC-GRUPO2-" . rand(100000, 999999),
            "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
            "tcCorreo" => $lcCorreo,
            'tcUrlCallBack' => $lcUrlCallBack,
            "tcUrlReturn" => $lcUrlReturn,
            'taPedidoDetalle' => $laPedidoDetalle
        ];

        $loResponse = $loClient->post($lcUrl, [
            'headers' => $laHeader,
            'json' => $laBody
        ]);

        $laResult = json_decode($loResponse->getBody()->getContents());

        if ($request->tnTipoServicio == 1) {
            // Generar la imagen QR
            $laValues = explode(";", $laResult->values)[1];
            $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;

            return Inertia::render('Pago/CreateVenta', [
                'qrImage' => $laQrImage,
                'message' => 'Generar QR para Servicio QR',
                'transaction' => null
            ]);
        } elseif ($request->tnTipoServicio == 2) {
            return Inertia::render('Pago/CreateVenta', [
                'qrImage' => null,
                'message' => 'Transacción Generada: ' . $laResult->values,
                'transaction' => $laResult->values, 
                'csrfToken' => csrf_token() 
            ]);
        }

    } catch (\Throwable $th) {
        return $th->getMessage() . " - " . $th->getLine();
    }
}

    public function ConsultarEstado(Request $request)
    {
        $lnTransaccion = $request->tnTransaccion;

        $loClientEstado = new Client();
        $lcUrlEstadoTransaccion = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/consultartransaccion";

        $laHeaderEstadoTransaccion = [
            'Accept' => 'application/json'
        ];

        $laBodyEstadoTransaccion = [
            "TransaccionDePago" => $lnTransaccion
        ];

        $loEstadoTransaccion = $loClientEstado->post($lcUrlEstadoTransaccion, [
            'headers' => $laHeaderEstadoTransaccion,
            'json' => $laBodyEstadoTransaccion
        ]);

        $laResultEstadoTransaccion = json_decode($loEstadoTransaccion->getBody()->getContents());
        $texto = '<h5 class="text-center mb-4">Estado Transacción: ' . $laResultEstadoTransaccion->values->messageEstado . '</h5><br>';

        return response()->json(['message' => $texto]);
    }
    public function urlCallback(Request $request)
    {
        $Venta = $request->input("PedidoID");
        $Fecha = $request->input("Fecha");
        $NuevaFecha = date("Y-m-d", strtotime($Fecha));
        $Hora = $request->input("Hora");
        $MetodoPago = $request->input("MetodoPago");
        $Estado = $request->input("Estado");

        try {
            $arreglo = ['error' => 0, 'status' => 1, 'message' => "Pago realizado correctamente.", 'values' => true];
        } catch (\Throwable $th) {
            
            $arreglo = ['error' => 1, 'status' => 1, 'messageSistema' => "[TRY/CATCH] " . $th->getMessage(), 'message' => "No se pudo realizar el pago, por favor intente de nuevo.", 'values' => false];
        }

        return response()->json($arreglo);
    }
}
