<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- ページの文字コードをUTF-8に設定 -->
    <meta charset="UTF-8">
    <!-- ページの幅をデバイスの幅に合わせる　-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>天気情報</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
    .move-right {
        margin-left: 20px; /* 左に20pxの余白を追加して、右に配置 */
    }
</style>

</head>
<body>
    <!-- ページの見出し -->
    <h1 class="display-5"><p  class="font-italic">全国の天気情報 net</h1>

    <!-- 地域選択のセレクトボックス表示フォーム -->
    <form action="{{ route('weather') }}" method="GET">
        <!-- 「地域を選択」というラベル -->
        <p class="move-right"><label for="city">地域を選択:</label>
        
        <!-- 地域選択用のセレクトボックス -->
        <select name="city" id="city">
            <option value="Tokyo" {{ request('city') == 'Tokyo' ? 'selected' : '' }}>東京</option>
            <option value="Osaka" {{ request('city') == 'Osaka' ? 'selected' : '' }}>大阪</option>
            <option value="Kyoto" {{ request('city') == 'Kyoto' ? 'selected' : '' }}>京都</option>
            <option value="Nagoya" {{ request('city') == 'Nagoya' ? 'selected' : '' }}>名古屋</option>
            <option value="Hokkaido" {{ request('city') == 'Hokkaido' ? 'selected' : '' }}>北海道</option>
            <option value="Fukuoka" {{ request('city') == 'Fukuoka' ? 'selected' : '' }}>福岡</option>
            // 必要に応じて他の地域を追加する
        </select>
        
        <!-- 「天気を確認」ボタン -->
        <button type="submit">天気を確認</button></p>
    </form>

    <!-- 天気情報がある場合にその情報を表示 -->
    @if($weather)
        <div>
            <h2 class="display-4"><p class="text-center">{{ $city }} の天気情報</h2><br><br>
            <h1 class="display-5"><p class="text-center"><strong>天気:</strong> {{ $weather['weather'][0]['description'] }}</p>
            <p class="text-center"><strong>気温:</strong> {{ $weather['main']['temp'] }}°C</p>
            <p class="text-center"><strong>湿度:</strong> {{ $weather['main']['humidity'] }}%</p>
            <p class="text-center"><strong>風速:</strong> {{ $weather['wind']['speed'] }} m/s</p>
        </div>
    @else
        <!-- 天気情報がない場合、エラーメッセージを表示 -->
        <p>天気情報が見つかりませんでした。</p>
    @endif

    <!-- jQuery (必要な場合) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js (必要な場合) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
