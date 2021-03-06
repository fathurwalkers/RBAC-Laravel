<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Detail;
use App\Models\Login;
use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;
use Nowakowskir\JWT\TokenEncoded;

class PanelService
{
    public $resultToken;

    public static function privateKey()
    {
        $privateKey = <<<EOD
        -----BEGIN RSA PRIVATE KEY-----
        Proc-Type: 4,ENCRYPTED
        DEK-Info: AES-128-CBC,7455A4B4E148B4CB205660315ADA7FAA
        
        a77izfc64X2jl9CxSYGNmvQtZUtwnipGMa9B8ExLP3gyUBOjyKMNd6sdnnd3aWI4
        H5NDc+HwGU3wB8CTNmqhlkWdi+OOdSU5jZJSvh1RIMyuM5u4MlpPyMFn9u8odhWb
        F4Pjy4BkAAA9mQiSKXFnc1AkiZ81/2FNeErM/4ZsSxDwEyE8I5pHUySxMA8y52R4
        V2AP6grj8A83i1n8te62v9W/QxDpySj3THhC0O6LDQhuFfLkl5UM+BfHdwBQyADA
        uz1CbFkNaw4H3UE/Z60nqh/S40m5Fx3m9LEATDHZR9VSYJ9+al9TpKf9LYsyMYJ3
        t/FTaSVlh83ZodQVyUZIN0eQUriGx9a7r/fXVKKFKROusTnLUpj39xvR5vIIOZ/y
        5jurpnnloAp+SlpzM/b4h8vTsnrvVXyMjngKkiSFF+D9zFtcIQEvxVS0iwyyiTa4
        AVLgWAq0lrAN1U3cUGavLEedY3IfUNhEcPs00diW5SfBwTZAdQKNW54r7vAscW1y
        r55CGntooYnYKe/+XDnY+HE06uXN/rCSElDb1JkKhsiUnmPKnWdC6GL6gQtR3unr
        +EAhIqO03GuDUmXQnkKqz0Towgp+n49ZHEdq8TVZjmz3R6u18Y4j5geUlX4kuq3G
        6VroxAJBXFfOBxJlvvJH4e77aPM1nVScGGTDZ/TeamhKbjOTEoqZ7b94evsr/XkM
        W1VRakZi9m4MOh37uYFSG4D9RuJ0/jJRq86cjwRm1T6GSFwa4Fs6xpCmLijo3m7x
        miqrWx+iMmCPNWePFJGnDWLuRQYs238ptl6dE/u78nZwB1Gi6Z7GM8BxUyaEYz+d
        QVs5ks82KLdvS+gPW1iZaydET6ZTCWumfGeU9jGgjsCllwf4JtIOfX0JSlkG3Tqu
        ArvpIwEXO7H2zLJypdDFjxiSwv8eOyiwWTGpk83L1vSROtxp7jrrzhQ/C1fmBEB/
        6M8Ms0vhuDeaV2aQHiXvRuic1JcgF116P1xyv8kKYgr7HTn9VKeZxIXRbboCXtkV
        Ya5mFhLGpowaW5rweWGNHEvsVj0X3ZbdEZEA9XYr2R42lgCBmjCL0sGgJ9Su832f
        F3RxmPwPgn7hoUGmrzr/xhorTXhrrbgUJXBII1JzHSLPpm2Gl26mn4Ir79FUhRz8
        QXSkqT8+eFA2VJhyzzTxxPzcZw2yblcdyHV++Y2E30r19KoEC8yATzFIIM5V/lGJ
        hJ3gW34l/FCsp0iNwF+UYzIbvksfBdMITM5dQRglzpp6yug8WXMxMigr+uFfGCTA
        dvU5+2C0KbY2PjLcx9cC7VeY/uGhM9HblH1edkPjyxTnbQfcOSbub2kz7Him7S86
        fKuX9WA10HhGGol1qex3Z4lrqUGOayY1VvfPyxjqjAWcgWKbo0EZg9kXDJ0wdrpF
        aHVazXU07WuFpBxgxWogCShp4TqpDDzVNAXV3yk2Z/jiUDo9AknGmn58w4SA5nfL
        KqBBnLCp/HOjQJSB3WAoU1Hrjn5Fo3z4m+n6UI/4n4zFoDdXrynU7Ea4qqv0iaBV
        4+hYyXoLbEkUrYx6ow78XaYQMVglli1ON8kItczUPmXgOAmE6k+aWrlKxMY4Kt3A
        +sWquo+0O2Kvb6BBTtnHPUl2st4yixoiXELqwsYYJq/g2jQ3MX5qZDopr5UQ6rec
        +Ct8x6yCdnmRpqUso+wdBECMbZ2RrhE4y0WqLlrzxHb2luem/yTnn3gCo/2hfhdb
        nfvKvLsvWfCqgUsD5xpB6X9vehjlALTLxST5z2aJ1XEBv8OTahEMtUlyMSEdH4MK
        3A6D3zJ7UaOnqzjMFqxascqVkVlVOw1ry2aWld69/ear0yLGx7vOYG+gg03T1VI0
        zSQ//1RAUGPP+REp4BloxU624ev1aowQxOJ5UjnND8AywehOdwQ2noK/3//qBk6U
        a26Q8YIGdSR28P5/zclFa7UH0RHk4S6SvQ0J0O4+Q/OFNTJWjMAR9vZDsztAepog
        uJhGuscOs0zi/G0NNhlmVIAUWETwq4Z6+hoYpVw+/sLMj9c3SEdnY9WjTyqXk+WJ
        rkOXPNexNqyhpm9rjZkTL15WXXbDsEeMyuZeT8v+4E1p3aMq7eLwZriJCBcjhRpB
        lfVTn6CZTZTUamg+Qf6uqou4NjutnoiFCDtA/g3uEYG2IRN7CFpOFyxGzNfuKUv/
        H6fdfXjt2muKStNWWNurbW907bYwlD5Gg8JwycDFlYrShLcneSZsllREbVE7YAiw
        oDVYux2voKrgEM8pAqhK2XK7Fw/9gyiyyy1Ua194+rF3EbKvVdbrrPcMqzruIdfN
        qteJYB9zQ2fGkgIqBFSH2OKX+jayKqiyPc7hZqMRkO77SoGFFyFiygGxx9IIAfyZ
        8L6BxH+3ft+IiEcA4pD33O0XNxramFOTY9cwkDg4radukLBT+hPyzOIyOjTWSJFi
        KRE2eNmglsGExQ1nVN8+bxWYrRsSI0rf7xXZ4hdme8vm7VF9zEeTWkcRJ66Ai223
        fZBh8pnYWW0UAYVO6v8qOo6gqqZ5/BSHpTVnYl+eBope9lyHJvd0/pK6v40U/3N2
        8FnmMMD6FVVcr8IkhoILC/TqF7n4T+hFtjSo91iNkycXTZzvGN3FEG+k28ZhaUpg
        V0NasCbArorIjF0+stcr3u07djcawWLhhIPosXYcmoPJ91DaoAswbMFpDTpTdVVE
        jep0mSblbhi4uO7y4DQ9iRvZ44jx8lsVTyRU46VRkp83EjQ6m+LUFyhAY75BdgqA
        BHFVBRfzsbtfONWY0cN3ii1VThwKET48q1S1KfKaefXNrjMt6EmOL+E28qVs2TMq
        u3VkCf287ABkUcEnl9DL091X9lml42bgl2UFMFOc8jHvDdD2YrJcnDeB48ZfqPys
        r1tf3jLZms6ZwUqVNeoBn1DYeXc72Gicf9H/wDxn6qPNVcyJCKVhL5Po5gzUnVlw
        Sl1SR9KpNyl/dHWe/sW71OWz99elED8jF3uKGlkGMEIARHjx6WclqTtS9VO9S/df
        QG//XWOLxCBcDTYIbThC/6j8qcppF7hFKQKdg0AOy6pwstZk5IM7+/VbLSffOcSN
        x6wLr76E9W0idMU2NcWbL43Bp0Txpd1cFExJnHg9yUxHbKJur3JxyguC0E6BEYBw
        -----END RSA PRIVATE KEY-----
        EOD;

        return $privateKey;
    }

    public function handle($datarequest)
    {
        $request = new Request;
        $username = $datarequest['login_username'];
        $password = $datarequest['login_password'];
        
        $cek_login = Login::where('login_username', $username)->first();
        if ($cek_login) {
            $cek_password = Hash::check($password, $cek_login->login_password);
            if ($cek_password) {
                $keys = PanelService::privateKey();
                $tokenDecoded = new TokenDecoded(['payload_key' => $cek_login], ['header_key' => 'HS256'], ['exp' => time() + 10000]);
                $tokenEncoded = $tokenDecoded->encode($keys, JWT::ALGORITHM_HS256);
                $data = array([
                    'token' => $tokenEncoded->toString(),
                    'result' => 'success',
                ]);
            } else {
                $data = array([
                    'result' => 'Fail Login 2!',
                ]);
            }
        } else {
            $data = array([
                'result' => 'Fail Login 1!',
            ]);
        }
        return $data;
    }
}
