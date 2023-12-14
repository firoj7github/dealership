<adf:document xmlns:adf="http://www.oracle.com/webfolder/technetwork/adf/">
    <adf:component>
        <adf:area>
            <adf:region>
                <adf:content>
                    <adf:outputText value="Hello,"/>
                    <adf:outputText value="A new car sale has been recorded with the following details:"/>
                    <adf:outputText value="Car Model: {{ $carDetails['model'] }}"/>
                    <adf:outputText value="Price: {{ $carDetails['price'] }}"/>
                    <!-- Other car details -->
                </adf:content>
            </adf:region>
        </adf:area>
    </adf:component>
</adf:document>


{{--<document>
    <component>
        <area>
            <outputText value="Hello,"/>
            <outputText value="A new car sale has been recorded with the following details:"/>
            <outputText value="Car Model: {{ $carDetails['model'] }}"/>
            <outputText value="Price: {{ $carDetails['price'] }}"/>
            <!-- Other car details -->
        </area>
    </component>
</document>--}}