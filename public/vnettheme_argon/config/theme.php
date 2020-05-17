<?php

return [
/*
|--------------------------------------------------------------------------
| 以下是用户界面设置
|--------------------------------------------------------------------------
*/
'Switch_language'     =>   true,    		//是否显示语言切换
'bg_color'            =>   "success",  		//背景色，可选default,primary,secondary,info,success,danger,warning
'tutorials_color'     =>   "warning", 		//使用教程界面背景色，可选default,primary,secondary,info,success,danger,warning,white,light,dark
'invite_color'        =>   "warning", 		//邀请码界面背景色，可选default,primary,secondary,info,success,danger,warning,white,light,dark
'referral_color'      =>   "warning",	    //邀请返利界面背景色，可选default,primary,secondary,info,success,danger,warning,white,light,dark
'purchase_color'      =>   "dark",			//结账界面背景色，可选default,primary,secondary,info,success,danger,warning,white,light,dark

'loading'             =>   true,       //是否加载过渡界面
'spinner'             =>   "spinner7", //过渡界面样式，可选spinner1至spinner7
'avatar'              =>   1,          //头像显示，0为固定，1为随机,选择固定时优先获取QQ头像

'show_group'          =>   true,       //侧边栏是否显示群组连接
'group_name'          =>   'Telegarm',       //群组名称
'group_link'          =>   'https://t.me/garhing',       //群组连接

'qq_group'            =>   true,       //侧边栏是否显示QQ群组连接
'qq_group_name'       =>   'QQ群号：111111',       //QQ群组名称
'qq_group_link'       =>   'https://jq.qq.com/?_wv=1111111',       //QQ群组连接
'qq_group_qrcode'     =>   '/argon/img/qq_qrcode.png',       //QQ群组二维码,需要根据自己设定的路径自行上传至指定的文件夹内

'referral_apply_show' =>   true,       //邀请返利界面是否显示邀请记录

'node_style'          =>   0,          //节点展示样式，0为列表，1为卡片
'node_link'           =>   true,       //节点是否允许查看配置链接
'node_txt'            =>   true,      //节点是否允许查看配置文本
'node_qrcode'         =>   true,       //节点是否允许查看配置二维码
'node_desc'           =>   false,       //节点是否展示节点描述，仅卡片样式有效
'node_label'          =>   false,       //节点是否展示节点标签，仅卡片样式有效
'node_rate'           =>   false,       //节点是否展示节点倍率，仅卡片样式有效

'tutorials_index'     =>   true,       //个人中心是否展示使用教程
'tutorials_show'      =>   true,       //教程界面是否重复展示使用教程
'windows_id'          =>   4,          //教程的文章ID，为0时不显示
'ios_id'              =>   6,          //教程的文章ID，为0时不显示
'android_id'          =>   7,          //教程的文章ID，为0时不显示
'mac_id'              =>   3,          //教程的文章ID，为0时不显示
'linux_id'            =>   5,          //教程的文章ID，为0时不显示

'Editor'              =>   1,          //回复工单时所用的富文本编辑器，0为wangEditor富文本编辑器，1为百度富文本编辑器

'product_id_1'		  =>   1,           //商品ID等于此值时可自定义价格，为0时不修改
'show_price_1'		  =>   200,         //自定义商品展示价格，product_id_1为0时无效
'show_cycle_1'		  =>   '年',        //自定义商品展示周期，product_id_1为0时无效

'product_id_2'		  =>   2,           //商品ID等于此值时可自定义价格，为0时不修改
'show_price_2'		  =>   20,          //自定义商品展示价格，product_id_2为0时无效
'show_cycle_2'		  =>   '季',        //自定义商品展示周期，product_id_2为0时无效

'product_id_3'		  =>   0,           //商品ID等于此值时可自定义价格，为0时不修改
'show_price_3'		  =>   2,           //自定义商品展示价格，product_id_2为0时无效
'show_cycle_3'		  =>   '月',        //自定义商品展示周期，product_id_2为0时无效

'product_card'		  =>   3,           //商品卡片展示每行个数，可选3或4
'product_price'		  =>   9999,        //商品某个周期价格等于此值时不显示，建议大于1000，以防出错



/*
|--------------------------------------------------------------------------
| 以下是登录界面设置
|--------------------------------------------------------------------------
*/

'switch_language'  =>   true,      //是否显示语言切换
'float_button'     =>   true,      //是否显示右下角按钮
'is_index'         =>   true,      //是否开启着陆页

/*
|--------------------------------------------------------------------------
| 以下是着陆页设置
|--------------------------------------------------------------------------
*/

'description_content' =>   '随时随地加速您的网络环境，帮助您访问您喜欢的网站和服务，改善网络体验，为您开辟全球业务保驾护航！',//网络简介

'header_title_1'      =>   '快速、稳定、智能的跨域上网方式',      //标题
'header_title_2'      =>   '是自由冲浪的最佳选择！',      //标题
'header_content'      =>   '马上点击下方开始您的稳定高速上网体验。',      //内容

'show_card_1'         =>   true,      //着陆页是否显示动效卡片
'card_title_1'        =>   '安全高效',      //卡片1标题
'card_content_1'      =>   '全站采用HTTPS加密，账号采用AES加密，保护您的真实IP和地理位置等身份信息。',      //卡片1内容
'card_label_1A'       =>   '安全',      //卡片1标签
'card_label_1B'       =>   '高效',      //卡片1标签
'card_label_1C'       =>   '专业',      //卡片1标签

'card_title_2'        =>   '快速稳定',      //卡片2标题
'card_content_2'      =>   '全自动均匀负载，多节点极速体验，各种流媒体网站解锁服务。',      //卡片2内容
'card_label_2A'       =>   '全球化',      //卡片2标签
'card_label_2B'       =>   '大宽带',      //卡片2标签
'card_label_2C'       =>   '本地内容',      //卡片2标签
 
'card_title_3'        =>   '游戏加速',      //卡片3标题
'card_content_3'      =>   '接入香港，日本，韩国等游戏CN2专线，畅游黑沙，彩虹，吃鸡，战地等热门游戏。',      //卡片3内容
'card_label_3A'       =>   '高可用',      //卡片3标签
'card_label_3B'       =>   '低延迟',      //卡片3标签
'card_label_3C'       =>   '多地容灾',      //卡片3标签

'show_card_2'         =>   true,      //着陆页是否显示管理说明
'card_2_title'        =>   '完善的管理面板',      //管理标题
'card_2_content'      =>   '使用自研插件和管理平台，给你带来远超业界平均水平的管理体验。再也无需记住繁杂的控制面板网站，只需要将我们的客户中心加入收藏即可！',      //管理内容
'card_2_label_A'      =>   '即时更新',      //管理标签
'card_2_label_B'      =>   '流畅操作',      //管理标签
'card_2_label_C'      =>   '完善体验',      //管理标签

'show_card_3'         =>   true,      //着陆页是否显示顾客关怀
'card_3A_title'       =>   '完善的系统支持',      //卡片标题
'card_3A_content'     =>   '我们提供Windows、iOS、Android、Mac等主流系统的客户端程序。',      //卡片内容
'card_3_title'        =>   '顾客关怀',      //卡片标题
'card_3_content_1'    =>   '24小时的工单系统让你无需再等待销售人员在线即可反馈问题，并且可以随时跟踪问题进展。',      //卡片内容
'card_3_content_2'    =>   '专业的工程师团队随时待命解决你的问题。',      //卡片内容
'card_3_content_3'    =>   '售后咨询解决你的其他烦恼。',      //卡片内容

'show_card_4'         =>   true,      //着陆页是否显示顾客关怀
'card_4A_title'       =>   '加速，只需要一步',      //卡片标题
'card_4A_content'     =>   '便捷的加速是高效生活的一部分。',      //卡片内容
'card_4B_title'       =>   '高效开通',      //卡片标题
'card_4B_content'     =>   '开通服务不再是需要等待半天的事情，只需要即刻下单，加速服务立刻呈现。',      //卡片内容
'card_4C_title'       =>   '高可用性',      //卡片标题
'card_4C_content'     =>   '你可以随时切换你所购买的资源，而不需要担心封锁。',      //卡片内容

'show_card_5'         =>   true,      //着陆页是否显示顾客关怀
'card_5_title'        =>   '超级友好的支持团队',      //管理标题
'card_5_content'      =>   '一个专业的团队，是成功的基础！',      //管理内容
'card_5_name_A'       =>   '杨过',      //管理标签
'card_5_job_A'        =>   '独臂码字',      //管理标签
'card_5_name_B'       =>   '小龙女',      //管理标签
'card_5_job_B'        =>   '一条威亚走天下',      //管理标签
'card_5_name_C'       =>   '韩夫人',      //管理标签
'card_5_job_C'        =>   '面具女神',      //管理标签
'card_5_name_D'       =>   '双儿',      //管理标签
'card_5_job_D'        =>   '大功告成',      //管理标签

'show_card_6'         =>   true,      //着陆页是否显示顾客关怀
'card_6_title'        =>   '我们为您简化了网络连接。',      //管理标题
'card_6_content'      =>   '打破传统的条条框框，重新打造新时代的冲浪体验！',      //管理内容

'show_card_7'         =>   true,      //着陆页是否显示顾客关怀
'card_7_title'        =>   '简单易用',      //管理标题
'card_7_content'      =>   '加速节点遍布国外各个互联网中心城市，为您提供最近的访问路径，解锁当地特有内容。从我们的加速节点，您与世界的距离近在咫尺！',      //管理内容
'card_7A_title'       =>   'Basic 订阅',      //管理标题
'card_7A_content'     =>   '为您提供基础云数据传输解决方案',      //管理内容
'card_7B_title'       =>   'Express 订阅',      //管理标题
'card_7B_content'     =>   '为您提供专业云数据传输解决方案',      //管理内容
'card_7C_title'       =>   'Relay 订阅',      //管理标题
'card_7C_content'     =>   '为您提供企业云数据传输解决方案',      //管理内容

'show_card_8'         =>   true,      //着陆页是否显示订阅提示
'card_8_title_1'      =>   '仅需一次订阅',      //订阅标题1
'card_8_title_2'      =>   '即可享受自由网络体验',      //订阅标题2
'card_8_content'      =>   '我们独有的控制面板,提供二维码扫描，支持各种终端设备一键导入配置,即使您不熟悉如何使用，也能第一时间上手。',      //订阅说明

'footer_title'        =>   '感谢您支持我们！',      //页脚标题
'footer_content'      =>   '您可以通过以下方式获取我们的最新动态。',      //页脚内容
'twitter_url'         =>   'null',      //twitter链接 ,null为不显示
'facebook_url'        =>   'null',      //facebook链接 ,null为不显示
'qq_url'              =>   'null',      //qq链接 ,null为不显示
'telegram_url'        =>   'null',      //telegram链接 ,null为不显示








];