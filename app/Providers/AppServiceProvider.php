<?php

namespace App\Providers;

use App\Menu;
use App\Messages;
use App\NewsCategories;
use App\ProductCategories;
use App\SiteDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        view()->composer('*' , function($view) {
            $allSiteDetails=SiteDetails::all();
            foreach ($allSiteDetails as $details)
            {
                $siteDetails[$details->key]=$details;
            }
            $user=Auth::user();
            $newsCategoriesProvider=NewsCategories::where('status','=','1')->with('parent')->get();
            $webMenusHeader=Menu::where([['menu_categories_id','=','1'],['status','=','1'] ])->with('parent')->orderBy('priority')->get();
            $webMenusFooter1=Menu::where([['menu_categories_id','=','2'],['status','=','1'] ])->with('parent')->orderBy('priority')->get();
            $webMenusFooter2=Menu::where([['menu_categories_id','=','3'],['status','=','1'] ])->with('parent')->orderBy('priority')->get();
            $panelMessages=array();
            if(isset($user->id))
                $panelMessages = Messages::where('user_id_reciver','=',$user->id)->orWhere('user_id_reciver','=',0)->orderBy('id','desc')->limit(5)->get();
            $view->with([
                'siteDetailsProvider' => $siteDetails,
                'newsCategoriesProvider'=>$newsCategoriesProvider,
                'webMenusHeaderProvider'=>$webMenusHeader,
                'webMenusFooter1Provider'=>$webMenusFooter1,
                'webMenusFooter2Provider'=>$webMenusFooter2,
                'user'=>$user,
                'panelMessages'=>$panelMessages,
            ]);
        });
    }
}
