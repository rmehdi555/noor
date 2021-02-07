<?php

namespace App\Console\Commands;

use App\Noor;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendSMSNoorMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noor:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send sms noor monthly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $noors=Noor::where([['type','=','کمک های نقدی'],['monthly_payment','=',1],['sms_monthly','<=',Carbon::now()->subMonth()]])->orWhere([['type','=','کمک های نقدی'],['monthly_payment','=',1],['sms_monthly','=',null]])->get()->groupBy('mobile');
        foreach ($noors as $key=>$value)
        {
            try {
                $username = config('app.smsPanelUser');
                $password = config('app.smsPanelPass');
                $from = config('app.smsPanelFrom');
                $pattern_code = "uhcz4lwsez";
                $to = array($key);
                $input_data = array("name" => ' ');
                $url = config('app.smsPanelUrl') .'?username='. $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
                $handler = curl_init($url);
                curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
                curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($handler);
            } catch (ApiException $e) {
                Log::error($e->errorMessage());
            } catch (HttpException $e) {
                Log::error($e->errorMessage());
            }
        }
        Noor::where([['type','=','کمک های نقدی'],['monthly_payment','=',1],['sms_monthly','<=',Carbon::now()->subMonth()]])->orWhere([['type','=','کمک های نقدی'],['monthly_payment','=',1],['sms_monthly','=',null]])->update([
            'sms_monthly'=>Carbon::now(),
        ]);

        return 0;
    }
}
