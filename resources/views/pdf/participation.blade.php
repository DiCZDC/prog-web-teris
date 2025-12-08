<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        font-family: 'Roboto', sans-serif;
    }

    /* Contenedor Principal del Certificado */
    .certificate-container {
        width: 900px;
        background-color: #000;
        position: relative;
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
        overflow: hidden;
    }

    /* Área Principal (Cuerpo Oscuro) */
    .main-body {
        /* Placeholder para la imagen de fondo de galaxia/amanecer */

        background: linear-gradient(180deg, #32235e 0%, #081a36 40%, #000000 65%);
        color: white;
        padding: 40px 60px;
        text-align: center;
        position: relative;
        min-height: 500px;
    }

    /* Placeholder Logo NASA (Arriba Izquierda) */
    .top-logo-placeholder {
        width: auto;
        height: 80px;
        background-color: rgba(255, 255, 255, 0.2);
        /* border: 2px dashed rgba(255, 255, 255, 0.5); */
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        /* color: #ddd; */
        position: absolute;
        top: 30px;
        left: 40px;
    }

    /* Badge Azul "Galactic Problem Solver" */
    .title-badge {
        background-color: #0057D9; /* Azul similar al original */
        display: inline-block;
        padding: 15px 60px;
        border-radius: 15px;
        margin-top: 100px;
        margin-bottom: 30px;
        width: 80%;
    }

    .title-badge h1 {
        color: #FFEE00; /* Amarillo intenso */
        font-weight: 900;
        font-size: 2.2rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* Textos del cuerpo */
    .intro-text {
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .recipient-name {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .description-text {
        font-size: 1.1rem;
        line-height: 1.5;
        max-width: 700px;
        margin: 0 auto 80px auto;
    }

    /* Sección Inferior (Firma y Fecha) */
    .bottom-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: auto;
        text-align: left;
    }

    /* Bloque Firma */
    .signature-block {
        max-width: 400px;
    }

    .signature-img-placeholder {
        width: 150px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px dashed #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        margin-bottom: 5px;
    }

    .highlight-yellow {
        color: #FFEE00;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 3px;
    }

    .small-text {
        font-size: 0.9rem;
        color: #fff;
    }

    /* Bloque Fecha */
    .date-block {
        text-align: left;
    }

    /* Footer Blanco */
    .footer {
        background-color: white;
        padding: 15px 40px;
        display: flex;
        align-items: center;
    }

    .footer-label {
        color: #333;
        font-weight: 700;
        font-size: 0.7rem;
        letter-spacing: 1px;
        margin-right: 15px;
        white-space: nowrap;
    }

    .footer-separator {
        width: 1px;
        height: 30px;
        background-color: #999;
        margin-right: 30px;
    }

    .partners-row {
        display: flex;
        gap: 40px;
        width: 100%;
        justify-content: space-around;
        align-items: center;
    }

    .partner-logo-placeholder {
        width: 60px;
        height: 30px;
        background-color: #eee;
        border: 1px dashed #999;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6rem;
        color: #555;
    }

</style>


<div class="certificate-container">
    
    <div class="main-body">
        
        <img class="top-logo-placeholder" alt="LOGO TERIS" src="https://lh3.googleusercontent.com/pw/AP1GczPldrhndLJ4PriR8KdVJOQjVFpOxtSs1JsFp_m96A2Qph9aiXgu920yv15-dkFEP-hYcTpoHh6d0biBlJiopzHMQzjQ4X303HV9ZTARaWhIVQ6ftYaNFYiawNYVYz-JrDVL7-uhgQsgyAnCRaCMAgHX=w500-h500-s-no?authuser=0">

        <div class="title-badge">
            <h1>Participante</h1>
        </div>

        <p class="intro-text">
            Por parte de Teris, se otorga el presente certificado a
        </p>

        <div class="recipient-name">
            {{$userName}}
        </div>

        <p class="description-text">
            por su destacada participación y esfuerzos para abordar<br>
            los desafíos presentados en el evento <strong>{{$eventName}}</strong>.<br>
        </p>

        <div class="bottom-row">
            <div class="signature-block">
                <!-- <div class="signature-img-placeholder">[Firma]</div> -->
                <div class="highlight-yellow">El crew de <strong>Teris</strong> te felicita</div>
                <div class="small-text">Organizadores de {{$eventName}}</div>
            </div>

            <div class="date-block">
                <div class="highlight-yellow">Fecha</div>
                <div class="small-text" style="font-size: 1.1rem;">{{$eventDate}}</div>
            </div>
        </div>

    </div>

    <div class="footer">
        <div class="footer-label">En colaboración con:</div>
        <div class="footer-separator"></div>
        
        <div class="partners-row">
            <div class="partner-logo-placeholder">LOGO 1</div>
            <div class="partner-logo-placeholder">LOGO 2</div>
            <div class="partner-logo-placeholder">LOGO 3</div>
            <div class="partner-logo-placeholder">LOGO 4</div>
            <div class="partner-logo-placeholder">LOGO 5</div>
        </div>
    </div>

</div>