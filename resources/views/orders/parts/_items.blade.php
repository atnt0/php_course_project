@foreach($orders as $key => $order)

    <tr>
        <td>
            {{ $order->id }}
        </td>
        <td>
            {{ $order->uuid }}
        </td>
        <td>
            {{ $order->comment }}
        </td>
        <td>
            {{ $order->client_first_name }}
            {{ $order->client_last_name }}
            {{ $order->client_patronymic_name }}
        </td>
        <td>
            {{ $order->email }}
            {{ $order->phone }}
        </td>
        <td>
            {{ $order->address_city }},
            {{ $order->address_zip }},
            {{ $order->address_street }},
            {{ $order->address_house }},
            {{ $order->address_floor }},
            {{ $order->address_apart }} <br>
            NP Office: {{ $order->address_np_number }}
        </td>
        <td>
            {{ $order->user_own_id }}
        </td>
        <td>
            {{ $order->guest_ip }}<br>
            {{ $order->guest_useragent }}
        </td>
        <td>
            <a href="{{ route('order.show', [$order->uuid]) }}" class="btn btn-primary">View</a>
        </td>
    </tr>
@endforeach
