<?xml version="1.0" encoding="UTF-8"?>
<adf>
    <prospect>
        <requestdate>2000-03-30T15:30:20-08:00</requestdate>
        <vehicle>
            <year>{{ $data['year'] }}</year>
            <make>{{$data['make'] }}</make>
            <model>{{ $data['model'] }}</model>
        </vehicle>
        <customer>
            <contact>
                <name part="full">{{ $data['customer_full_name'] }}</name>
                <phone>{{ $data['customer_phone'] }}</phone>
            </contact>
        </customer>
        <vendor>
            <contact>
                <name part="full">LocalCarz.com</name>
            </contact>
        </vendor>
    </prospect>
</adf>