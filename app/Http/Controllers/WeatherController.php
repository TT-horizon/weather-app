<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Weather; // Weatherモデルを使用
use Carbon\Carbon;
use Log;

class WeatherController extends Controller
{
	public function getWeather(Request $request)
	{
		// ユーザーが選択した地域を取得、デフォルトは東京
		$city = $request->input('city', 'Tokyo'); // デフォルトは東京
    	$date = Carbon::today()->toDateString(); // 今日の日付を取得

		// 都市名を日本語に変換
		$cityNames = [
			'Tokyo' => '東京',
			'Osaka' => '大阪',
			'Kyoto' => '京都',
			'Nagoya' => '名古屋',
			'Hokkaido' => '北海道',
			'Fukuoka' => '福岡',
			// 他の都市もここに追加
		];

		$cityInJapanese = $cityNames[$city] ?? $city; // 存在しない場合は元の地域名を使用

   		// **データベースに天気情報があるかチェック**
    	$weatherData = Weather::where('city', $city)->where('date', $date)->first();

    	if (!$weatherData) {
        	// **データがない場合は API から取得**
        	$apiKey = env('OPENWEATHER_API_KEY');
        	$url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=ja";
        	$response = Http::get($url);
        	$weatherData = $response->json();

        	// **取得した天気情報をDBに保存**
			Log::info('Attempting to insert weather data:', ['city' => $city, 'date' => $date, 'data' => $weatherData]);
        	Weather::create([
            	'city' => $city,
            	'date' => $date,
            	'data' => json_encode($weatherData) // JSON形式で保存
        	]);
			Log::info('Weather data inserted successfully.');

    	} else {
        	// **DBに保存されているデータを取得**
        	$weatherData = json_decode($weatherData->data, true);
    	}

    	return view('weather', ['weather' => $weatherData, 'city' => $cityInJapanese]);
	}
}

