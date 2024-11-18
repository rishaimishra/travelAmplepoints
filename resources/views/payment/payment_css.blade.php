<style type="text/css">

    .hidden {
        display: none;
    }

    #payment-message {
        color: red;
        font-size: 16px;
        line-height: 20px;
        padding-top: 12px;
        text-align: center;
    }

    #payment-element {
        margin-bottom: 24px;
    }

    /* Buttons and links */
    .stripe_btn {
        background: #5469d4;
        font-family: Arial, sans-serif;
        color: #ffffff;
        border-radius: 4px;
        border: 0;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
    }

    .stripe_btn:hover {
        filter: contrast(115%);
    }

    .stripe_btn:disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
        border-radius: 50%;
    }

    .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    .spinner:before,
    .spinner:after {
        position: absolute;
        content: "";
    }

    .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #5469d4;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
    }

    .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #5469d4;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
    }

    @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @media only screen and (max-width: 600px) {
        form {
            width: 80vw;
            min-width: initial;
        }
    }

    #wrap {

        /*background-image: -ms-linear-gradient(top, #FFFFFF 0%, #D3D8E8 100%);
        background-image: -moz-linear-gradient(top, #FFFFFF 0%, #D3D8E8 100%);
        background-image: -o-linear-gradient(top, #FFFFFF 0%, #D3D8E8 100%);/
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #FFFFFF), color-stop(1, #D3D8E8));
        background-image: -webkit-linear-gradient(top, #FFFFFF 0%, #D3D8E8 100%);
        background-image: linear-gradient(to bottom, #FFFFFF 0%, #D3D8E8 100%);
        background-repeat: no-repeat;
        background-attachment: fixed;*/

    }

    legend {
        color: #141823;
        font-size: 25px;
        font-weight: bold;
        border-bottom: 1px solid #f75d00;
        text-align: center;
    }

    .ap_signup_btn {
        background: #f75d00;
        background-image: -webkit-linear-gradient(top, #f75d00, #f75d00);
        background-image: -moz-linear-gradient(top, #f75d00, #f75d00);
        background-image: -ms-linear-gradient(top, #f75d00, #f75d00);
        background-image: -o-linear-gradient(top, #f75d00, #f75d00);
        background-image: linear-gradient(to bottom, #f75d00, #f75d00);
        -webkit-border-radius: 4;
        -moz-border-radius: 4;
        border-radius: 4px;
        text-shadow: 0px 1px 0px #f75d00;
        -webkit-box-shadow: 0px 0px 0px #f75d00;
        -moz-box-shadow: 0px 0px 0px #f75d00;
        box-shadow: 0px 0px 0px #f75d00;
        font-family: Arial;
        color: #ffffff;
        font-size: 20px;
        padding: 10px 20px 10px 20px;
        border: solid #f75d00 1px;
        text-decoration: none;
        width: 100%;
        height: auto;
        line-height: normal;
    }

    .ap_signup_btn:hover {
        background: #f75d00;
        background-image: -webkit-linear-gradient(top, #f75d00, #f75d00);
        background-image: -moz-linear-gradient(top, #f75d00, #f75d00);
        background-image: -ms-linear-gradient(top, #f75d00, #f75d00);
        background-image: -o-linear-gradient(top, #f75d00, #f75d00);
        background-image: linear-gradient(to bottom, #f75d00, #f75d00);
        text-decoration: none;
        color: #ffffff;
    }

    .navbar-default .navbar-brand {
        color: #fff;
        font-size: 30px;
        font-weight: bold;
    }

    .form .form-control {
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 5px;
    }

    @media (min-width: 768px) {
        #home {
            margin-top: 50px;
        }

        #home .slogan {
            color: #0e385f;
            line-height: 29px;
            font-weight: bold;
        }
    }

    .no_left_padding {
        padding-left: 0px;
    }

    .no_right_padding {
        padding-right: 0px;
    }

    @media only screen and (max-width: 768px) {
        .no_right_padding {
            padding-left: 0px;
        }

        .no_left_padding {
            padding-right: 0px;
        }
    }

    .reg_frm_container {
        background: #f3f3f3 none repeat scroll 0 0;
        border: 4px solid #f75d00;
        box-sizing: border-box;
        box-shadow: 0 3px 5px 1px #565656;
        border-radius: 9px;
        position: relative;
        width: 100%;
        float: left;
        padding: 25px;
        margin-bottom: 15px;
    }

    .soc-abs {
        border-bottom: 1px solid #f75d00;
    }

    .icon_title1 {
        margin: -33px 0 5px;
    }

    @media only screen and (max-width: 768px) {

        .all-start {
            margin-top: 0px;
        }

        #wrap {
            padding: 0px !important;
        }

        #columns {
            padding-left: 0px;
            padding-right: 0px;
        }

        .center_column {
            padding: 0px !important;
        }

        .reg_frm_container {
            padding: 10px;
        }

        .my_frm_cntr {
            padding: 7px !important;
        }
    }


    .all-start #columns .row {
  margin-left: 0;
  margin-right: 0;
}

</style>