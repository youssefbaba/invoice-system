 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Pdf</title>
     <style>
         .table {
            border-collapse: collapse;
             width: 100%;
             border: 1px solid black;
         }


        table {
        width: 100%;
        border-collapse: collapse;
        }

         .tabl td {
             text-align: left;
             padding: 10px;
             border: 1px solid white;
         }

         .tabl tr:nth-child(even) {
            background-color: #c1d9ef;
         }

         .tabl th {
             border: 1px solid white;
             text-align: left;
             background-color: #84B4DF;
             color: white;
         }
         .notactive {
            display: inline-block;
            margin-right: 30px;
        }
        .logo{
            text-align: center;

        }
     </style>

 </head>

 <body>
        <div class="logo">
            <img src="{{public_path('Logo1.JPG')}}" alt="Logo" style="border-radius: 50%;" width="100" height="100">
        </div>

        {{-- <div>
            <table style="width:100%">

            </table>
        </div> --}}

        <div>
            <table style="width:100%;">
                <tr>
                    <td><h2>Facture&nbsp;{{$facture->code_facture}} : {{$facture->etat_facture}}</h2></td>
                    <td style="margin-left:10px;padding-left:10px"><p><span style="font-weight: bold;">Date création facture :</span> &nbsp;{{$facture->created_at->format('Y-m-d')}}</p></td>
                </tr>
                <tr>
                  <td><h2>Destinataire</h2></td>
                  <td style="margin-left:10px;padding-left:10px"><h2>Envoyer à</h2></td>
                </tr>
                <tr>
                  <td><span style="font-weight: bold;">Entreprise :</span>&nbsp;Devosoft</td>
                  <td style="margin-left:10px;padding-left:10px"><span style="font-weight: bold;">Client :</span> &nbsp;{{$facture->getClient($facture->client_id)->nom_client}}&nbsp;{{$facture->getClient($facture->client_id)->prenom_client}}</td>
                </tr>
                <tr>
                    <td><a style="text-decoration: none; color:black"
                        href="mailto:contact@devosoft.ma"
                        style="color:black"><span style="font-weight: bold;">Email :</span> &nbsp;contact@devosoft.ma</a>
                    </td>
                    <td style="margin-left:10px;padding-left:10px"><a style="text-decoration: none; color:black"
                        href="mailto:{{$facture->getClient($facture->client_id)->adresse_email_client}}"
                        style="color:black"><span style="font-weight: bold;">Email :</span> &nbsp;{{$facture->getClient($facture->client_id)->adresse_email_client}}</a>
                    </td>
                </tr>
                <tr>
                    <td> <span style="font-weight: bold;">Adresse :</span> &nbsp;  Apprt N°14 Rue 135, 1er Etage Qu El Massira-Safi (M)</td>
                    <td style="margin-left:10px;padding-left:10px"> <span style="font-weight: bold;">Adresse :</span> &nbsp; {{$facture->getClient($facture->client_id)->adresse_client}}</td>
                </tr>
                <tr>
                    <td><a style="text-decoration: none; color:black"
                        href="tel:0525988911"
                        style="color:black"><span style="font-weight: bold;">Tel :</span> &nbsp; 0525988911</a></td>
                    <td style="margin-left:10px;padding-left:10px"><a style="text-decoration: none; color:black"
                        href="tel:{{$facture->getClient($facture->client_id)->tel_client}}"
                        style="color:black"><span style="font-weight: bold;">Tel :</span> &nbsp; {{$facture->getClient($facture->client_id)->tel_client}}</a>
                    </td>
                </tr>
              </table>
        </div>
         <div class="tabl" style="margin-top: 15px;">
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Prix unitaire HT</th>
                            <th>Quantité</th>
                            @if ($facture->getArticle($facture->id)->tva != null)
                            <th>TVA</th>
                            @else
                            @endif
                            @if ($facture->getArticle($facture->id)->reduction_article != null)
                            <th>Réduction</th>
                            @else
                            @endif
                            <th>Total HT</th>
                            <th>Devise</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                        <tr>
                            <td>{{$article->type_article}}</td>
                            <td>{{$article->description_article}}</td>
                            <td>{{$article->prix_ht_article}} </td>
                            <td>{{$article->quantité_article}}</td>
                            @if ($facture->getArticle($facture->id)->tva != null)
                            <td>{{$article->tva}}%</td>
                            @else
                            @endif
                            @if ($facture->getArticle($facture->id)->reduction_article != null)
                            <td>{{$article->reduction_article}}%</td>
                            @else
                            @endif
                            <td>{{$article->total_ht_article}}</td>
                            <td> {{$facture->devis}}</td>
                        </tr>
                        @endforeach
                        @isset($facture->getDebours($facture->id)->montant_ht_debours)
                        @foreach ($debourses as $debours)
                        <tr>
                            <td>Débours</td>
                            <td>Ref:{{$debours->ref_debours}},{{$debours->description_debours}}</td>
                            <td></td>
                            <td></td>
                            @if ($facture->getArticle($facture->id)->tva != null)
                            <td></td>
                            @else
                            @endif
                            @if ($facture->getArticle($facture->id)->reduction_article != null)
                            <td></td>
                            @else
                            @endif
                            <td>{{$debours->montant_ht_debours}}</td>
                            <td> {{$facture->devis}}</td>
                        </tr>
                        @endforeach
                        @endisset
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total HT</td>
                            <td>{{$facture->total_ht_articlesf}}</td>
                            <td> {{$facture->devis}}</td>
                        </tr>
                        @if ($facture->getArticle($facture->id)->tva != null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>TVA</td>
                            <td>{{$facture->tvaf}}</td>
                            <td> {{$facture->devis}}</td>
                        </tr>
                        @else
                        @endif
                        @isset($facture->getDebours($facture->id)->montant_ht_debours)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Débours</td>
                            <td>{{$facture->total_debours}}</td>
                            <td> {{$facture->devis}} </td>
                        </tr>
                        @endisset
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total TTC</td>
                            <td >{{$facture->total_facturef}}</td>
                            <td> {{$facture->devis}}</td>
                        </tr>
                    </tbody>
                </table>
         </div>
         <div>
            <h2 style="margin-bottom: 0px;">Conditions</h2>
            <table style="width:100%;margin-bottom: 20px">
                <tr>
                    <td><p><span style="font-weight: bold;">Conditions de règlement :</span> &nbsp;{{$facture->condition_reglf}}</p></td>
                    <td><p><span style="font-weight: bold;">Mode de règlement :</span> &nbsp;{{$facture->mode_reglf}}</p></td>
                    <td><p><span style="font-weight: bold;">Intérêt de retard :</span> &nbsp;{{$facture->interet_reglf}}</p></td>
                </tr>
            </table>
         </div>


 </body>

 </html>
