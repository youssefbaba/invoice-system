 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Pdf</title>
     <style>
         table {
             border-collapse: collapse;
             width: 100%;
         }

         td {
             text-align: left;
             padding: 8px;
         }

         tr:nth-child(even) {
             background-color: #f2f2f2
         }

         th {
             text-align: left;
             background-color: #8a8a8a;
             color: white;
         }

     </style>

 </head>

 <body>
     <div class="row container">
         <h1 class="text-center font-weight-bold">F{{$facture->created_at->format('Y')}}{{$facture->id}} &nbsp;: &nbsp;{{$facture->created_at->format('Y-m-d')}}</h1>
         <h2 class="text-center font-weight-bold"></h2>
         <div class="col-md-6">
             <h2 class="font-weight-bold">Informations</h2>
             <div class="row">
                <div class="col-xs-4">
                    <p class="text-muted">Status:</p>
                </div>
                <div class="col-xs-8">
                    <p>@if ($facture->client_id == null)
                        Incompléte
                        @else
                        {{$facture->etat_facture}}
                        @endif</p>
                </div>
            </div>

             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Créée le:</p>
                 </div>
                 <div class="col-xs-8">
                     <p>{{$facture->created_at}}</p>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             @if ($facture->created_at != $facture->updated_at)
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Dernière modification le:</p>
                 </div>
                 <div class="col-xs-8">
                     <p>{{$facture->updated_at}}</p>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             @else
             @endif
         </div>
         <div class="col-md-6">
             @if ($facture->client_id == null)
             <h2 class="font-weight-bold text-danger">Destinataire</h2>
             @else
             <h2 class="font-weight-bold">Destinataire</h2>
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Destinataire:</p>
                 </div>
                 <div class="col-xs-8">
                     <a style="text-decoration: none; color:black" href="{{route('voirplus',$facture->client_id)}}"
                         style="color:black">{{$facture->getClient($facture->client_id)->nom_client}}</a>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Société:</p>
                 </div>
                 <div class="col-xs-8">
                     <p style="color: red">{{$facture->getClient($facture->client_id)->societe_client}} hadi n9dar
                         n7aydha ola n9adha </p>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Adresse:</p>
                 </div>
                 <div class="col-xs-8">
                     <p>{{$facture->getClient($facture->client_id)->adresse_client}}</p>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Ville:</p>
                 </div>
                 <div class="col-xs-8">
                     <p>{{$facture->getClient($facture->client_id)->ville_client}}</p>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Numéro de téléphone:</p>
                 </div>
                 <div class="col-xs-8">
                     <a style="text-decoration: none; color:black"
                         href="tel:{{$facture->getClient($facture->client_id)->tel_client}}}}"
                         style="color:black">{{$facture->getClient($facture->client_id)->tel_client}}</a>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Adresse email:</p>
                 </div>
                 <div class="col-xs-8">
                     <a style="text-decoration: none; color:black"
                         href="mailto:{{$facture->getClient($facture->client_id)->adresse_email_client}}"
                         style="color:black">{{$facture->getClient($facture->client_id)->adresse_email_client}}</a>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Site internet:</p>
                 </div>
                 <div class="col-xs-8">
                     <a style="text-decoration: none; color:black"
                         href="{{$facture->getClient($facture->client_id)->site_client}}"
                         style="color:black">{{$facture->getClient($facture->client_id)->site_client}}</a>
                 </div>
             </div>
             @endif
         </div>
         <div class="col-md-6">
             <h2 class="font-weight-bold">Conditions</h2>
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Conditions de règlement:</p>
                 </div>
                 <div class="col-xs-8">
                     <p>{{$facture->condition_reglf}}</p>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Mode de règlement:</p>
                 </div>
                 <div class="col-xs-8">
                     <p>{{$facture->mode_reglf}}</p>
                 </div>
             </div>
             <hr style="margin: 0.5px">
             <div class="row">
                 <div class="col-xs-4">
                     <p class="text-muted">Intérêt de retard:</p>
                 </div>
                 <div class="col-xs-8">
                     <p>{{$facture->interet_reglf}}</p>
                 </div>
             </div>
         </div>
         <div class="col-md-12">
             <h2 class="font-weight-bold ">Détail</h2>
             <table class="table table-striped table-responsive col-md-12">
                 <thead>
                     <tr>
                         <th scope="col" class="text-muted">Type</th>
                         <th scope="col" class="text-muted">Description</th>
                         <th scope="col" class="text-muted">Prix unitaire HT</th>
                         <th scope="col" class="text-muted">Quantité</th>
                         @if ($facture->getArticle($facture->id)->tva != null)
                         <th scope="col" class="text-muted">TVA</th>
                         @else
                         @endif
                         @if ($facture->getArticle($facture->id)->reduction_article != null)
                         <th scope="col" class="text-muted">Réduction</th>
                         @else
                         @endif
                         <th scope="col" class="text-muted">Total HT</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($articles as $article)
                     <tr>
                         <td scope="col">{{$article->type_article}}</td>
                         <td scope="col">{{$article->description_article}}</td>
                         <td scope="col">{{$article->prix_ht_article}} {{$facture->devis}} </td>
                         <td scope="col">{{$article->quantité_article}}</td>
                         @if ($facture->getArticle($facture->id)->tva != null)
                         <td scope="col">{{$article->tva}}%</td>
                         @else
                         @endif
                         @if ($facture->getArticle($facture->id)->reduction_article != null)
                         <td scope="col">{{$article->reduction_article}}%</td>
                         @else
                         @endif
                         <td scope="col">{{$article->total_ht_article}}</td>
                         <td scope="col"> {{$facture->devis}}</td>
                     </tr>
                     @endforeach
                     @isset($facture->getDebours($facture->id)->montant_ht_debours)
                     @foreach ($debourses as $debours)
                     <tr>
                         <td scope="col">Débours</td>
                         <td scope="col">Ref:{{$debours->ref_debours}},{{$debours->description_debours}}</td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         @if ($facture->getArticle($facture->id)->tva != null)
                         <td scope="col"></td>
                         @else
                         @endif
                         @if ($facture->getArticle($facture->id)->reduction_article != null)
                         <td scope="col"></td>
                         @else
                         @endif
                         <td scope="col">{{$debours->montant_ht_debours}}</td>
                         <td scope="col"> {{$facture->devis}}</td>
                     </tr>
                     @endforeach
                     @endisset
                     <tr>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col" class="font-weight-bold">Total HT</td>
                         <td scope="col">{{$facture->total_ht_articlesf}}</td>
                         <td scope="col"> {{$facture->devis}}</td>
                     </tr>
                     @if ($facture->getArticle($facture->id)->tva != null)
                     <tr>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col" class="font-weight-bold">TVA</td>
                         <td scope="col">{{$facture->tvaf}}</td>
                         <td> {{$facture->devis}}</td>
                     </tr>
                     @else
                     @endif
                     @isset($facture->getDebours($facture->id)->montant_ht_debours)
                     <tr>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col" class="font-weight-bold">Débours</td>
                         <td scope="col">{{$facture->total_debours}}</td>
                         <td> {{$facture->devis}} </td>
                     </tr>
                     @endisset
                     <tr>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col"></td>
                         <td scope="col" class="font-weight-bold">Total TTC</td>
                         <td scope="col">{{$facture->total_facturef}}</td>
                         <td> {{$facture->devis}}</td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>

     <!-- Latest compiled and minified JavaScript -->
     {{-- <script src="{{ asset('js/bootstrap.bundle.js') }}" ></script> --}}

 </body>

 </html>
