<?php namespace App\Http\Controllers\Wechat;
use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/15/15
 * Time: 2:53 PM
 */
use App\Keyword;
use App\Wechat;
use App\WechatNews;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
/*
 * 微信交互控制器
 * @param $wechatId 公众号ID
 * */
class WechatController extends Controller{

    public function index($wechatId)
    {
        //获取微信公众号信息
        $wechat = Wechat::find($wechatId);

        $appId          = $wechat->app_id;
        $token          = $wechat->wechat_token;
        $encodingAESKey = $wechat->encoding_aes_key; // 可选

        // $encodingAESKey 可以为空
        $server = new Server($appId, $token, $encodingAESKey);

        /*
         * 监听指定类型
         * */
        $server->on('message', 'text', function($message) use ($wechatId){
            return $this->reply($message,$wechatId);
        });

        $result = $server->serve();

        return $result;
    }

    public function reply($message,$wechatId)
    {
        /*
         * 监听事件类型
         * 关注事件回复
         * */


        //获取关键词对象
        //查询关键字,预载入关键字规则
        $keyword = Keyword::with(['keywordRule'=>function($query) use ($wechatId){

            $query->where('wechat_id','=',$wechatId);

        }])->whereRaw('wechat_id = ? and keyword like ? ',[$wechatId,$message->Content])->firstOrFail();

        //查询对应回复   一对多
        $replies = $keyword->keywordRule->reply;
        if($replies){
            foreach ($replies as $key => $reply) {
                $contents[$key] = $reply->{$reply->reply_type};
                $contents[$key]['reply_type'] = $reply->reply_type;
            }
            //取随机数
            $num = mt_rand(0,count($replies)-1);
            $content = $contents[$num];
            switch($content['reply_type'])
            {
                case 'text':
                    return Message::make($content['reply_type'])->content($content->content);
                    break;
                case 'image':
                case 'voice':
                case 'video':
                case 'location':
                    return Message::make($content['reply_type'])->content($content->content);
                    break;
                case 'news':
                    //查询内容
                    $news = WechatNews::find($content->content);
                    if($news){
                        return Message::make('news')->items(function() use ($news){
                            return array(
                                Message::make('news_item')->title($news->title)->url($news->news_url)->picUrl($news->cover)
                            );
                        });
                    }else{
                        return '';
                    }

                    breadk;
                default:
                    return Message::make($content['reply_type'])->content($content->content);
                    break;
            }
        }else{
            return '';
        }

    }

    /*
     * 获取回复消息对象
     * 关注回复、关键字回复、自定义菜单等。
     * */
    public function getMessageObject()
    {
         //return $message;
        return 'text';
    }


}