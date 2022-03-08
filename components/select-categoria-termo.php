<?php
function setCategoria(){
    if(!empty($_SESSION['termo'])){
        if ($_SESSION['termo'][0]['tipo'] == 'conceito') {
            $tipo = "conceito";
            $conceito = '<option selected value="conceito">Conceito (ex: Ação Social, Fato Social, Etnocentrismo)</option>';
            $teorico = '<option value="teórico">Teórico (ex: Durkheim, Weber, Comte)</option>';
        }
        if ($_SESSION['termo'][0]['tipo'] == 'teórico') {
            $tipo = "teórico";
            $teorico = '<option selected value="teórico">Teórico (ex: Durkheim, Weber, Comte)</option>';
            $conceito = '<option value="conceito">Conceito (ex: Ação Social, Fato Social, Etnocentrismo)</option>';
        }
        return '<select required class="custom-select" id="select-termo" name="tipoTermo" value="' . $tipo . '">' . $conceito . '
    ' . $teorico . '
  </select>';
    }
}