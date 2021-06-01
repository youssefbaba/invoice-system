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
    <!-- Optional theme -->
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css')}}"> --}}
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="bootstrap/css/bootstrap.css"> --}}

</head>

<body>

    <div class="logo">
        <img src="{{public_path('Logo1.JPG')}}" alt="Logo" style="border-radius: 50%;" width="100" height="100">
    </div>

    <div>
        <table style="width:100%;">
            <tr>
                <td><h2>Devis&nbsp;{{$devise->code_devis}} : {{$devise->etat_devis}}</h2></td>
                <td style="margin-left:10px;padding-left:10px"><p><span style="font-weight: bold;">Date création devis :</span> &nbsp;{{$devise->created_at->format('Y-m-d')}}</p></td>>
            </tr>
            <tr>
              <td ><h2>Destinataire</h2></td>
              <td style="margin-left:10px;padding-left:10px"><h2>Envoyer à</h2></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold;">Entreprise :</span>&nbsp;Devosoft</td>
              <td style="margin-left:10px;padding-left:10px"><span style="font-weight: bold;">Client :</span> &nbsp;{{$devise->getClient($devise->client_id)->nom_client}}&nbsp;{{$devise->getClient($devise->client_id)->prenom_client}}</td>
            </tr>
            <tr>
                <td><a style="text-decoration: none; color:black"
                    href="mailto:contact@devosoft.ma"
                    style="color:black"><span style="font-weight: bold;">Email :</span> &nbsp;contact@devosoft.ma</a>
                </td>
                <td style="margin-left:10px;padding-left:10px"><a style="text-decoration: none; color:black"
                    href="mailto:{{$devise->getClient($devise->client_id)->adresse_email_client}}"
                    style="color:black"><span style="font-weight: bold;">Email :</span> &nbsp;{{$devise->getClient($devise->client_id)->adresse_email_client}}</a>
                </td>
            </tr>
            <tr>
                <td> <span style="font-weight: bold;">Adresse :</span> &nbsp;  Apprt N°14 Rue 135, 1er Etage Qu El Massira-Safi (M)</td>
                <td style="margin-left:10px;padding-left:10px"> <span style="font-weight: bold;">Adresse :</span> &nbsp; {{$devise->getClient($devise->client_id)->adresse_client}}</td>
            </tr>
            <tr>
                <td><a style="text-decoration: none; color:black"
                    href="tel:0525988911"
                    style="color:black"><span style="font-weight: bold;">Tel :</span> &nbsp; 0525988911</a></td>
                <td style="margin-left:10px;padding-left:10px"><a style="text-decoration: none; color:black"
                    href="tel:{{$devise->getClient($devise->client_id)->tel_client}}"
                    style="color:black"><span style="font-weight: bold;">Tel :</span> &nbsp; {{$devise->getClient($devise->client_id)->tel_client}}</a>
                </td>
            </tr>
          </table>
    </div>

        <div class="tabl" style="margin-top: 20px">
            <table class="table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Prix unitaire HT</th>
                        <th>Quantité</th>
                        @if ($devise->getArticle($devise->id)->tva != null)
                        <th>TVA</th>
                        @else
                        @endif
                        @if ($devise->getArticle($devise->id)->reduction_article != null)
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
                        <td>{{$article->prix_ht_article}}</td>
                        <td>{{$article->quantité_article}}</td>
                        @if ($devise->getArticle($devise->id)->tva != null)
                        <td>{{$article->tva}}%</td>
                        @else
                        @endif
                        @if ($devise->getArticle($devise->id)->reduction_article != null)
                        <td>{{$article->reduction_article}}%</td>
                        @else
                        @endif
                        <td>{{$article->total_ht_article}}</td>
                        <td>{{$devise->devis}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total HT</td>
                        <td>{{$devise->total_ht_articlesdf}}</td>
                        <td>{{$devise->devis}}</td>
                    </tr>
                    @if ($devise->getArticle($devise->id)->tva != null)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>TVA</td>
                        <td>{{$devise->tvadf}}</td>
                        <td>{{$devise->devis}}</td>
                    </tr>
                    @else
                    @endif
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total TTC</td>
                        <td>{{$devise->total_facturedf}}</td>
                        <td>{{$devise->devis}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h2 style="margin-bottom: 0px;">Conditions</h2>
            <table style="width:100%;margin-bottom: 20px">
                <tr>
                    <td style="text-align: left;"><p><span style="font-weight: bold;">Conditions de règlement :</span> &nbsp;{{$devise->condition_regld}}</p></td>
                    <td style="text-align: left;"><p><span style="font-weight: bold;">Mode de règlement :</span> &nbsp;{{$devise->mode_regld}}</p></td>
                    <td style="text-align: left;"><p><span style="font-weight: bold;">Intérêt de retard :</span> &nbsp;{{$devise->interet_regld}}</p></td>
                </tr>
            </table>
         </div>



</body>

</html>
