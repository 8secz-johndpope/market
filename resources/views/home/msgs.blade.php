@foreach($cur->messages as $message)
    @if($message->previous()&&$message->previous()->day()!==$message->day()||!$message->previous())
        <div class="day-seperator"><span class="day-seperator-text">{{$message->day()}}</span> </div>
    @endif

    @if($message->type==='invoice')
        @if($message->from_msg===$user->id)
            <div class="right-message">
                <span>
                                                @if($message->invoice->status==1)<span class="green-text">Paid</span> @else  <span class="yellow-text">Pending</span> @endif
                                            </span>
                <span class="message"> Invoice Sent for {{$message->invoice->amount()}} &nbsp;&nbsp; <span class="message-time"> {{$message->timestamp()}}</span> </span>
                
            </div>

        @else
            <div class="left-message"><span class="message get-invoice"> Got Invoice for {{$message->invoice->amount()}}  &nbsp;&nbsp;  <span class="message-time"> {{$message->timestamp()}}</span></span>
                <span>
                                                @if($message->invoice->status==1)<span class="green-text">Paid</span> @else  <a class="btn btn-primary btn-pay" href="/pay/invoice/{{$message->invoice->id}}">Pay Here</a> @endif
                                            </span>
            </div>


        @endif

    @else

        @if($message->from_msg===$user->id)

            <div class="right-message"><span class="message"> {{$message->message}}&nbsp;&nbsp; <span class="message-time"> {{$message->timestamp()}}</span> </span></div>
        @else
            <div class="left-message"><span class="message">{{$message->message}}&nbsp;&nbsp;  <span class="message-time"> {{$message->timestamp()}}</span></span></div>
        @endif
    @endif
@endforeach