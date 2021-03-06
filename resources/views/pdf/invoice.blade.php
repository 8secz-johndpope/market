<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>


    <style>
        .page-break {
            page-break-after: always;
        }
        .customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .customers td, .customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .customers tr:nth-child(even){background-color: #f2f2f2;}

        .customers tr:hover {background-color: #ddd;}

        .customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        body{
            font-size: 0.8em;
        }
        .header-brand,.footer-brand{
            width: 100%;
        }
        .header-brand{
            margin-top: -50px;
        }

    </style>
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <img src="{{env('APP_URL')}}/css/brand.png" style="width: 100%">

        <table class="customers" >
            <tr><td>Name</td><td>{{$user->name}}</td></tr>
            <tr><td>Company</td><td>{{$user->business->name}}</td></tr>
            <tr><td>Email</td><td>{{$user->email}}</td></tr>
            <tr><td>Phone</td><td>{{$user->business->phone}}</td></tr>
            <tr><td>Billing Address</td><td>{{$user->business->address->line1}}</td></tr>
        </table>
        <table class="customers">
            <tr><th>Title</th><th>Category</th><th>Location</th><th>Quantity</th><th>Price</th></tr>
            @foreach($contract->packs as $pack)
                <tr><td>{{$pack->title}}</td><td>{{$pack->category->title}}</td><td>{{$pack->location->title}}</td><td>{{$contract->count}}</td><td>£{{$pack->amount/100}}</td></tr>
            @endforeach
            <tr><td><span class="bold-text">Subtotal</span></td><td></td><td></td><td><span class="bold-text">{{count($contract->packs)*$contract->count}}</span></td><td><span class="bold-text"> £{{$contract->total_before_discount()}}</span></td></tr>
            <tr><td><span class="bold-text">Discount</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$contract->total_discount()}}</span></td></tr>
            <tr><td><span class="bold-text">Subtotal after discount</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$contract->total_after_discount()}}</span></td></tr>
            <tr><td><span class="bold-text">VAT @ 20%</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$contract->total_vat()}}</span></td></tr>
            <tr><td><span class="bold-text">Total</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$contract->total_after_vat()}}</span></td></tr>
        </table>
        <img src="{{env('APP_URL')}}/css/footerbrand.png" style="width: 100%">
        <div class="page-break"></div>
        <img src="{{env('APP_URL')}}/css/brand.png" style="width: 100%">
<h4>Payment Schedule</h4>
<table class="customers">
    <tr><th>Reference</th><th>Payment Date</th><th>Amount</th></tr>
    @foreach($contract->payments as $payment)
        <tr><td>{{$payment->reference}}</td><td>{{$payment->nice_date()}}</td><td> £{{$payment->nice_amount()}}</td></tr>
    @endforeach
</table>
        <br><br> <br><br>
       <h4>Terms and Conditions</h4>
        <p>1. The account holder will pay for the committed purchase in full whether or not it is used. </p>
        <p>2. These credits are to be used in the areas above and the areas above only.</p>
        <p>3. Any adverts posted outside of these designated areas will be charged in full separately. </p>
        <p>4. The Company confirms that it is VAT registered and it’s VAT number is. </p>
        <p>the Company confirms it is not, and is not required to be, VAT registered. By not filling in this box</p>

        <img src="{{env('APP_URL')}}/css/footerbrand.png" class="footer-brand">

        <div class="page-break"></div>
        <img src="{{env('APP_URL')}}/css/brand.png" class="header-brand">

<h4>Terms and Conditions</h4>
        <p>Standard Advertising Terms and Conditions</p>
        <h4>1 Parties</h4>
        <p>The parties are:</p>
        <p>(a) {{env('APP_NAME')}},a subsidiary of BGC Global Parnters LLC and assigned to  Investors in Ideas Ltd (company number: 07320409), in the United Kingdom({{env('APP_NAME')}});
and</p>
        <p>(b) the Company as detailed in the {{env('APP_NAME')}} Insertion Order Form ("Company").</p>
        <h4>2 Agreement</h4>
        <p>2.1 These terms and conditions; the {{env('APP_NAME')}}.com website Terms and Conditions, and the {{env('APP_NAME')}}.com Privacy Policy shall form this agreement ("Agreement").
        </p><p>2.2 Company's use of Company's {{env('APP_NAME')}} account shall be subject to this Agreement.
        </p><p>2.3 Notwithstanding {{env('APP_NAME')}}'s acceptance of the {{env('APP_NAME')}} Insertion Order Form or display of any impressions, {{env('APP_NAME')}} may remove or refuse to publish or link to any material which in its sole discretion is considered defamatory, misleading, abusive, unlawful, inappropriate or otherwise in breach of this Agreement, promotes competitive services to those provided by {{env('APP_NAME')}} or its affiliated companies or does not comply with {{env('APP_NAME')}}'s technical requirements.
        </p> <p>2.4. Where applicable, {{env('APP_NAME')}} may restrict or discontinue the delivery of any advertisements or other communications to any or all users containing advertisements or promotions featuring Company: (a) if {{env('APP_NAME')}} is satisfied in its reasonable judgement that to send such material to users may expose {{env('APP_NAME')}} or Company to the risk of sanctions under applicable laws; or (b) if any individual user has opted out or otherwise indicated to {{env('APP_NAME')}} that he or she does not want to receive any advertisements or promotions for services provided by any company other than {{env('APP_NAME')}} or its affiliated companies.
        </p>
        <h4>3 Term</h4>
        <p>3.1 This Agreement shall be deemed to have commenced on the later of the dates inserted by the signatories below ("Start Date") and shall continue in force until the expiry date of the package determined by time period specified in the {{env('APP_NAME')}} Insertion Order Form ("End Date"). The term of the Agreement shall be from the Start Date to the End Date ("Term").
        </p>


        <h4>4 Fees and Payment</h4>
        <p>4.1 In consideration for posting advertisements on the {{env('APP_NAME')}}.com website ("Site "), Company shall pay {{env('APP_NAME')}} the fees product that Company wishes to post on the Site as detailed in the {{env('APP_NAME')}} Insertion Order Form ("Fee").
        </p><p>4.2 {{env('APP_NAME')}} shall issue the Company Monthly in arrears invoice payable via Invoice ("{{env('APP_NAME')}} Invoice").
        </p><p>4.3 If Company wishes to post advertisements over and above Company's package allowance, {{env('APP_NAME')}} shall invoice Company for such additional advertising, and Company shall pay the full cost of such advertising.
        </p>
        <p>4.4 Company shall pay initial {{env('APP_NAME')}} Invoice within 90 days of receipt.</p>
        <p>Subsequent invoices or fees due as per schedule</p>

        <h4>5 Warranties</h4>
        <p>5.1 Each party to this Agreement represents and warrants and undertakes to the other that it has, and shall retain throughout the Term, all right, title and authority to enter into, and perform all of its obligations under this Agreement.
        </p>
        <img src="{{env('APP_URL')}}/css/footerbrand.png" class="footer-brand">

        <div class="page-break"></div>
        <img src="{{env('APP_URL')}}/css/brand.png" class="header-brand">
        <p>5.2 Company represents, warrants and undertakes throughout the Term that Company (a) complies with, and shall continue to comply with, all laws and regulations as may be applicable to Company posting job advertisements on the Site; and (b) complies with, and shall continue to comply all applicable Data Protection laws and regulations including but not limited to the EU Data Protection Directive 95/46/EC, The Data Protection Act 1998, The Privacy and Electronic Communications (EC Directive) Regulations 2003 and any other applicable data protection legislation.</p>

        <h4>6 Indemnities
        </h4>
        <p>6.1 Company shall indemnify {{env('APP_NAME')}} (and its employees, directors and agents) against any liability, damage, expense, claim or cost (including reasonable legal fees and costs) suffered by {{env('APP_NAME')}} arising from any: (a) breach of warranties in clause 5; or (b) breach of clause 11 (Confidentiality).
        </p>
        <h4>7 Limitation of Liability</h4>
        <p>7.1 Nothing in this Agreement shall exclude or limit liability for death or personal injury resulting from the negligence of either party or their servants, agents or employees.
        </p><p>7.2 With the exception of: (a) clause 7.1 above; (b) Company's obligations to pay {{env('APP_NAME')}} under clause 4 (Fees and Payment); and (c) the indemnities in clause 6 (Indemnities), the liability of either party in contract, tort, negligence, pre-contract or other representations or otherwise arising out of this Agreement or the performance of its obligations under this Agreement shall be limited in aggregate to the total amount payable under the Agreement as specified in clause 4.
        </p>

        <h4>8 Licences and Intellectual Property
        </h4>
        <p>8.1 Company grants to {{env('APP_NAME')}} a non-exclusive, royalty-free, world-wide licence to use, reproduce and display the Company logo, content, code and material provided by or on behalf of the Company ("Company Materials") on the Site and in any {{env('APP_NAME')}} marketing materials in the form provided by Company, save for any formatting changes necessary for display on the Site or other agreed changes.
        </p><p>8.2 Except as otherwise provided in this Agreement, as between {{env('APP_NAME')}} and Company: (i) {{env('APP_NAME')}} retains all right, title and interest in and to all intellectual property rights in or associated with the Site, and all {{env('APP_NAME')}} services and (ii) Company retains all rights, title and interest in and to all intellectual property rights in or associated with the Company Materials.
        </p>

        <h4>9. Termination
        </h4>
        <p>9.1 This Agreement shall terminate automatically on the End Date specified in the {{env('APP_NAME')}} Insertion Order Form or as otherwise specified in the {{env('APP_NAME')}} Insertion Order Form. {{env('APP_NAME')}} shall be entitled to immediately terminate this Agreement by notice in writing and remove any advertisements from its site without notice in the event it deems, in its sole discretion, that it is likely to incur liability as a result of any act or omission or breach of this Agreement by the Company. If {{env('APP_NAME')}} terminates this Agreement pursuant to this clause any monies then already paid to {{env('APP_NAME')}} pursuant to this Agreement shall be non refundable. Either party may terminate this Agreement immediately by notice in writing to the other if the other party: (a) is in material breach of the Agreement and, in the case of a breach capable of remedy, fails to remedy the breach within 15 days of receipt of written notice giving full details of the breach and of the steps required to remedy it; or (b) passes a resolution for winding up (otherwise than for the purposes of a solvent amalgamation or reconstruction) or a court makes an order to that effect; or (c) becomes or is declared insolvent or convenes a meeting of or makes or proposes to make any arrangement or composition with its creditors; or (d) has a liquidator, receiver, administrator, administrative receiver, manager, trustee or similar officer appointed over any of its assets; or (e) ceases, or threatens to cease, to carry on business or (f) the other party suffers or there occurs in relation to that party any event which in the reasonable opinion of the non-defaulting party is analogous to any of the events referred to in sub-clauses (b) to (e) in any part of the world. Any termination of this Agreement for any reason shall be without prejudice to Company's obligations pursuant to clause 5 and 6.
        </p>

        <h4>10 Consequences of Termination
        </h4><p>10.1 Any termination of this Agreement shall not affect any accrued rights or liabilities of either party nor shall it affect the status of any provision of this Agreement which is expressly or by implication intended to come into or continue in force on or after such termination. Clauses 4 (Fees and Payment), 5 (Warranties), 6 (Indemnities), 7 (Limitation of Liability), 10 (Consequences of Termination), 11 (Confidentiality), and 12 (General) shall continue to have effect after the end of the Term.

        </p>
        <img src="{{env('APP_URL')}}/css/footerbrand.png" class="footer-brand">

        <div class="page-break"></div>
        <img src="{{env('APP_URL')}}/css/brand.png" class="header-brand">
        <h4>11 Confidentiality</h4>
        <p>11.1 Each of the parties shall not disclose to any person any information, whether in written or any other form, disclosed by or on behalf of one party ("Disclosing Party") to the other party ("Receiving Party") in the course of the discussions leading up to or the entering into or during the performance of this Agreement and which is identified as confidential or is clearly by its nature confidential including, but not limited to, the Works provided by Company under this Agreement and all personal data relating to {{env('APP_NAME')}}'s users as well as any other information internal to {{env('APP_NAME')}} or any {{env('APP_NAME')}} subsidiary, holding or parent company (and any of their subsidiaries) ("Confidential Information") except insofar as: (a) is required by a person employed or engaged by the Receiving Party in connection with the proper performance of this Agreement (but only to the extent that any person to whom the information is disclosed needs to know the same for the performance of their duties and provided the Receiving Party shall be obliged to procure that all such persons are aware of the obligation of confidentiality and undertake to comply with it); or (b) is required to be disclosed by law (provided that the party disclosing the information shall notify the other party of the information to be disclosed and of the circumstances in which the disclosure is alleged to be required as early as reasonably possible before such disclosure shall be made and takes all reasonable action to avoid and limit such disclosure).
        </p><p>11.2 Any disclosure of Confidential Information shall be in confidence, shall only be to the extent that any persons to whom the information is disclosed need to know the same for the performance of their duties and the Receiving Party shall procure that all such persons are aware of the obligation of confidentiality and undertake to comply with it.
        </p><p>11.3 Each of the parties shall use the Confidential Information solely in connection with the performance of this Agreement and not otherwise for its own benefit or the benefit of any third party.

        </p><p>11.4 Confidential Information does not include information which: (a) is generally available to the public otherwise than as a direct or indirect result of disclosure by the Receiving Party or a person employed or engaged by the Receiving Party contrary to their respective obligations of confidentiality; or (b) is made available or becomes available to the Receiving Party otherwise than under this Agreement and free of any restrictions as to its use or disclosure.
        </p><p>11.5 Without prejudice to any other rights or remedies that the Disclosing Party may have, the Receiving Party agrees that if the Confidential Information is used or disclosed other than in accordance with the terms of this Agreement, the Disclosing Party shall, without proof of special damage, be entitled to an injunction, specific performance or other equitable relief for any threatened or actual breach of the provisions of this clause, in addition to any damages or other remedy to which it may be entitled.
        </p><p>11.6 Company shall not disclose to {{env('APP_NAME')}}, or bring onto {{env('APP_NAME')}}'s premises, or induce {{env('APP_NAME')}} to use, any third party confidential information.
        </p> <p>11.7 This clause shall continue in force for a period of five years from the termination or expiry of this Agreement howsoever caused.
        </p>

        <h4>12 General
        </h4>
        <p>12.1 If a party is prevented from performing any or all of its obligations of this Agreement by any act, event, omission or condition beyond a party's control (a "Force Majeure Event"), the affected party shall give written notice to the other party within two (2) business days of the occurrence of the Force Majeure Event and the affected party shall be excused from such performance during, but not longer than, the continuance of such Force Majeure Event. Each party shall bear their own costs arising from the Force Majeure Event and shall take all reasonable steps to find ways to perform their obligations despite the Force Majeure Event. If the Force Majeure Event continues for more than thirty (30) consecutive days, the other party may immediately terminate this Agreement on giving written notice to the affected party.</p>
        <p>12.2 This Agreement (including any documents referred to) (the "Contractual Documents") contains the entire agreement between the parties relating to the subject matter covered in the Contractual Documents and supersedes any previous agreements, arrangements, undertakings, negotiations, discussions or proposals, written or oral, between the parties in relation to such matters. No oral explanation or oral information given by any party shall alter the interpretation of the Contractual Documents. Each party confirms that, in agreeing to enter into the Contractual Documents, it has not relied on any statement, representation, warranty, understanding, undertaking, promise or assurance (whether negligently or innocently made) of any person save insofar as the same has expressly been made in the Contractual Documents and agrees that it shall have no remedy in respect of any misrepresentation which has notbecome a term of the Contractual Documents except that this Clause shall not apply in respect of any fraudulent or negligent misrepresentation whether or not such has become a term of the Contractual Documents.</p>
        <img src="{{env('APP_URL')}}/css/footerbrand.png" class="footer-brand">

        <div class="page-break"></div>
        <img src="{{env('APP_URL')}}/css/brand.png" class="header-brand">
        <p>12.3 Nothing in this Agreement shall be construed as creating a partnership or joint venture of any kind between the parties or as constituting or authorising either party as the agent of the other party for any purpose whatsoever. Neither party shall have the authority or power to bind the other, or to contract in the name of, or hold itself out as, or create a liability against the other in any way or for any purpose.</p><p>12.4 Neither party shall assign (including by way of a charge or declaration of trust) sub-license or deal in any way with this Agreement or any of its rights under this Agreement, without the prior written consent of the other party, such consent not be unreasonably withheld or delayed, provided that each party shall have the right to assign this Agreement to a subsidiary, holding or parent company (and any of their subsidiaries) of that party on prior written notice to the other party.</p>
        <p>12.5 Except as expressly set out in this Agreement, a person who is not a party to this Agreement has no right to rely upon or enforce any term of this Agreement.
        </p><p>12.6 The validity, construction and performance of this Agreement (and any claim, dispute or matter arising under or in connection with it or its enforceability) shall be governed by and interpreted in accordance with the laws of England and Wales. Each party irrevocably agrees to the exclusive jurisdiction of the English courts over any claim, dispute or matter arising under or in connection with this Agreement or its enforceability or the legal relationships established by this Agreement.
        </p><p>12.7 Neither party shall advertise or publicly announce, communicate or circulate the existence or terms of this Agreement or any association with the other party without the prior written consent of the other party.
        </p><p>12.8 Any notice given under this Agreement shall be in writing in English and served by hand, fax, prepaid recorded or special delivery post or prepaid international recorded airmail. In the case of {{env('APP_NAME')}}, notices shall be given to its Financial Director at the address specified in the Agreement. In the case of Company, notice shall be sent to the address referred to in this Agreement. Any such notice shall be deemed to have been served at the time of delivery. The parties shall notify each other of changes in addresses for service during the Term of this Agreement.
        </p><p>12.9 If any clause of this Agreement is found by any court or administrative body of competent jurisdiction to be invalid or unenforceable, such invalidity or unenforceability shall not affect the other provisions of this Agreement which shall remain in full force and effect.
        </p><p>12.10 The failure to exercise or delay in exercising a right or remedy under this Agreement shall not constitute a waiver of the right or remedy or a waiver of any other rights or remedies and no single or partial exercise of any right or remedy under this Agreement shall prevent any further exercise of the right or remedy or the exercise of any other right or remedy. The rights and remedies contained in this Agreement are cumulative and not exclusive of any rights or remedies provided by law.
        </p> <p>12.11 No modification or variation of this Agreement shall be valid if made by email and shall otherwise only be valid if in writing and signed for or on behalf of each of the parties.
        </p><p>12.12 Company shall execute or cause to be executed all such other documents and do or cause to be done all such further acts and things (consistent with the terms of this Agreement) as {{env('APP_NAME')}} may from time to time reasonably require.
        </p><p>12.13 This Agreement may be signed in duplicate, each of which, when signed, shall be original, and all the duplicates together shall constitute the same Agreement.
        </p><p>{{env('APP_NAME')}}
        </p><p>I have read, understood and agree to the {{env('APP_NAME')}} standard terms and conditions above:</p>
        <img src="{{env('APP_URL')}}/css/footerbrand.png" class="footer-brand">

    </div>
</div>
</body>
</html>