<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 上午9:57
 */
require_once "../common/data/include.php";

$guide = array(
    'en' => array(
        '1001' => 'mimayu2FA',
        '1001_1' => '2FA是什么？',
        '1001_1_1' => '2FA的全称是双重验证(Two-Factor Authentication)，是在密码(一级保护)的基础上，增加验证码(二级保护)的账户双重保护机制。其中，验证码的部分我们称之为2FA。',
        '1001_1_2' => '2FA的原理是，用户在自己的手机上下载一个2FA的APP(本期仅支持VIP Access)，首次打开VIP Access扫描平台的二维码，激活成功后，在需要的时候输入VIP Access上本账号的验证码，即可完成2FA验证。您在两个场景下需要用到2FA。您在两个场景下需要用到2FA。',
        '1001_1_3' => '您在两个场景下需要用到2FA。',
        '1001_1_4' => '场景一',
        '1001_1_5' => '您激活2FA后，每次登录都需要输入验证码，验证通过后方可登录成功。',
        '1001_1_6' => '场景二',
        '1001_1_7' => '每次提现的时候，都需要输入验证码，验证通过后方可提现。',
        '1001_2' => '如何激活2FA？',
        '1001_2_1' => '步骤一、您需要在您的设备上下载一个身份认证APP。',
        '1001_2_2' => '对于iOS、安卓的用户，我们推荐：Google Authenticator、Authy、LastPass、VIP Access。（备注：Authy和LastPass提供了云存储，可在您丢失设备后快速找回您的验证码。）',
        '1001_2_3' => '步骤二、登录系统，到“我的账号”，点“重新激活2FA”，然后按照屏幕的提示进行操作即可。',
        '1001_2_4' => '大致的步骤包括：&lt;br&gt;1. 打开设备上的身份认证APP扫描本平台的二维码；&lt;br&gt;2. 在本平台输入对应账号的验证码，点“激活”即可。',
        '1001_2_5' => '备注：',
        '1001_2_6' => '1. 激活2FA以后，基于安全考虑，2FA需要有一个生效时间24小时，即，您需要等待24小时才可开始“提现”操作。&lt;br&gt; 2. 请写下、打印或复制好“激活key”，并保存到安全的地方。激活key可在您丢失设备的时候帮助您重新在另一台设备上激活2FA。',
        '1001_3' => '如何更改2FA的APP和设备？',
        '1001_3_1' => '2FA一旦激活成功，您可在任何时间更改身份认证APP或身份认证设备。',
        '1001_3_2' => '步骤一、您需要在您的新设备上下载一个身份认证APP，或在旧设备上下载新的身份认证APP。',
        '1001_3_3' => '&lt;br&gt;3. 在本平台输入对应账号的验证码，点“激活”即可。',
        '1002' => '充值与提现',
        '1002_1' => '如何充值？',
        '1002_2' => '充值时间与费率？',
        '1002_3' => '如何提现？',
        '1002_4' => '提现时间与费率？',
        '1002_5' => '我们支持哪些数字资产？',
        '1003' => '买入与卖出',
        '1003_1' => '如何买入数字资产组合？',
        '1003_2' => '如何卖出数字资产组合？',
        '1004' => '身份认证与会员权限',
        '1004_1' => '为什么我需要身份认证？',
        '1004_2' => '会员等级和权益分别有哪些？',
        '1004_3' => '如何升级至1级？',
        '1004_4' => '如何升级至2级？',
        '1004_5' => '我们支持哪些护照和身份证？',
        '1004_6' => '我们不支持哪些居民使用？',
        '1005' => '安全',
        '1005_1' => '平台如何保障数字资产安全？',
        '1005_2' => '如何保障自己的账户安全？',
        '1006' => '常见问题',
    ),
    'cn' => array(
        '1001' => '密码与2FA',
        '1001_1' => '2FA是什么？',
        '1001_1_1' => '2FA的全称是双重验证(Two-Factor Authentication)，是在密码(一级保护)的基础上，增加验证码(二级保护)的账户双重保护机制。其中，验证码的部分我们称之为2FA。',
        '1001_1_2' => '2FA的原理是，用户在自己的手机上下载一个2FA的APP(本期仅支持VIP Access)，首次打开VIP Access扫描平台的二维码，激活成功后，在需要的时候输入VIP Access上本账号的验证码，即可完成2FA验证。您在两个场景下需要用到2FA。您在两个场景下需要用到2FA。',
        '1001_1_3' => '您在两个场景下需要用到2FA。',
        '1001_1_4' => '场景一',
        '1001_1_5' => '您激活2FA后，每次登录都需要输入验证码，验证通过后方可登录成功。',
        '1001_1_6' => '场景二',
        '1001_1_7' => '每次提现的时候，都需要输入验证码，验证通过后方可提现。',
        '1001_2' => '如何激活2FA？',
        '1001_2_1' => '步骤一、您需要在您的设备上下载一个身份认证APP。',
        '1001_2_2' => '对于iOS、安卓的用户，我们推荐：Google Authenticator、Authy、LastPass、VIP Access。（备注：Authy和LastPass提供了云存储，可在您丢失设备后快速找回您的验证码。）',
        '1001_2_3' => '步骤二、登录系统，到“我的账号”，点“重新激活2FA”，然后按照屏幕的提示进行操作即可。',
        '1001_2_4' => '大致的步骤包括：&lt;br&gt;1. 打开设备上的身份认证APP扫描本平台的二维码；&lt;br&gt;2. 在本平台输入对应账号的验证码，点“激活”即可。',
        '1001_2_5' => '备注：',
        '1001_2_6' => '1. 激活2FA以后，基于安全考虑，2FA需要有一个生效时间24小时，即，您需要等待24小时才可开始“提现”操作。&lt;br&gt; 2. 请写下、打印或复制好“激活key”，并保存到安全的地方。激活key可在您丢失设备的时候帮助您重新在另一台设备上激活2FA。',
        '1001_3' => '如何更改2FA的APP和设备？',
        '1001_3_1' => '2FA一旦激活成功，您可在任何时间更改身份认证APP或身份认证设备。',
        '1001_3_2' => '步骤一、您需要在您的新设备上下载一个身份认证APP，或在旧设备上下载新的身份认证APP。',
        '1001_3_3' => '&lt;br&gt;3. 在本平台输入对应账号的验证码，点“激活”即可。',
        '1002' => '充值与提现',
        '1002_1' => '如何充值？',
        '1002_2' => '充值时间与费率？',
        '1002_3' => '如何提现？',
        '1002_3_1' => '一、前提条件：',
        '1002_3_2' => '如果您需要提现，那么您需要先激活2FA。（请点此查看',
        '1002_3_3' => '激活2FA以后，您需要等待24小时才可开始“提现”操作。',
        '1002_3_4' => '二、提现步骤如下：',
        '1002_3_5' => '1. 登录系统，点“提现”菜单；&lt;br&gt;2. 选择需要提现哪种数字资产；&lt;br&gt;3. 输入需要提现的数字资产数量、接收地址，点“预览”并确认交易；&lt;br&gt;4. 输入设备身份认证APP上的验证码（2FA）；&lt;br&gt;5. 到邮箱中确认交易信息；&lt;br&gt;6. 确认完成后，本次交易涉及的数字资产将从您在BitUP的账户转移到接收地址对应的钱包账户',
        '1002_3_6' => '请注意：',
        '1002_3_7' => '提现交易需要手续费，具体您可至<a href="/guide/#2-4" target="_blank" class="common-link color-blue">提现时间与费率</a>查看提现费用的详情信息。',
        '1002_3_8' => '数字资产交易时，接收地址请使用复制、粘贴的方式，请勿手打地址。',
        '1002_3_9' => '请务必确认接收地址对应的钱包支持您打算存入的数字资产。',
        '1002_3_10' => '在进行大额交易之前，建议先用小金额做下测试。',
        '1002_3_11' => '区块链上所有完成的交易都是最终的结果，<span class="color-red">发送给错误接收地址的数字资产将永远丢失！</span>',
        '1002_4' => '提现时间与费率？',
        '1002_4_1' => 'BitUP支持提现的各类数字资产，其提现执行时间和费率分别如下：',
        '1002_4_2' => '数字资产',
        '1002_4_3' => '交易确认',
        '1002_4_4' => '到账时间',
        '1002_4_5' => '提现手续费',
        '1002_4_6' => '需要6次确认',
        '1002_4_7' => '需要12次确认',
        '1002_4_8' => '0～60分钟',
        '1002_4_9' => '0～3分钟',
        '1002_4_10' => '笔交易',
        '1002_5' => '我们支持哪些数字资产？',
        '1002_5_1' => 'BitUP平台支持以下数字资产：',
        '1002_5_2' => '<span class="color-red">不要直接从BitUP支付（转账）给BitUP</span>，因为平台不支持你持有的数字资产的回报，并且有可能无法恢复！',
        '1003' => '买入与卖出',
        '1003_1' => '如何买入数字资产组合？',
        '1003_1_1' => '您在本平台已充值了比特币（BTC）或以太坊（ETH）。',
        '1003_1_2' => '二、买入步骤如下：',
        '1003_1_3' => '登录系统，点“交易中心”菜单，或点“现有资产”菜单；',
        '1003_1_4' => '查看需要购买的数字资产组合，点“买入”；',
        '1003_1_5' => '根据页面提示，填写买入订单。（您需要选择用哪种数字资产进行购买、填写购买的DAC数量或需要花费的数字资产）；',
        '1003_1_6' => '确认订单无误，点“提交订单”即可。',
        '1003_1_7' => '交易金额限制',
        '1003_1_8' => '每笔买入交易的最低交易金额是$ 10.00。',
        '1003_1_9' => '每个数字资产组合在24小时内可买入的最高交易金额是$ 10,000.00。',
        '1003_1_10' => '交易费用',
        '1003_1_11' => '买入手续费：',
        '1003_1_12' => '卖出手续费：',
        '1003_1_13' => '管理费',
        '1003_1_14' => '不同数字资产组合的管理费可能不同，本平台的管理费按年化计算。比如，假设某个数字资产组合的管理费是3%，那么平台每天收取3%/365的费用，这不会改变您持有的数字资产或数字资产组合的数量。',
        '1003_1_15' => '您只能用充值进BitUP的比特币或以太坊购买数字资产组合',
        '1003_1_16' => '您可随时检查本次交易的状态。（方法：登录系统→点“交易记录”菜单→找到对应的交易，查看详情）',
        '1003_2' => '如何卖出数字资产组合？',
        '1003_2_1' => '您在本平台已购买了数字资产组合。',
        '1003_2_2' => '二、卖出步骤如下',
        '1003_2_3' => '查看需要卖出的数字资产组合，点“卖出”；',
        '1003_2_4' => '根据页面提示，填写卖出订单。（您需要选择卖出后收取哪种数字资产、填写卖出的DAC数量或兑换的数字资产）；',
        '1003_2_5' => '卖出数字资产组合后，您只能选择收到比特币或以太坊。',
        '1004' => '身份认证与会员权限',
        '1004_1' => '为什么我需要身份认证？',
        '1004_1_1' => '根据KYC和《反洗钱法》的要求，用户只有在身份认证通过后，才可以获得更多的充值和提现额度。',
        '1004_1_2' => '身份验证需求如下：',
        '1004_1_3' => '升级至1级：需要验证您的基本信息、设备信息。',
        '1004_1_4' => '升级至2级：需要视频验证您的真实身份、真实意愿。',
        '1004_1_5' => '我们将为您在平台填写的信息保密，并且保证这些信息只应用于合理合法的用途。',
        '1004_1_6' => '我们的身份认证分成了多个等级，不同等级的身份认证会为您带来不同的充值和提现额度。比如，验证个人基本信息和手机号通过后，会员可升级至1级，拥有$ 1,000的充值和提现额度。',
        '1004_2' => '会员等级和权益分别有哪些？',
        '1004_2_1' => 'BitUP目前提供了3个会员等级，其权限和升级要求如下：',
        '1004_2_2' => '会员等级',
        '1004_2_3' => '等级权限',
        '1004_2_4' => '升级要求',
        '1004_2_5' => '验证您的邮箱',
        '1004_2_6' => '验证您的个人基本信息、手机号',
        '1004_2_7' => '视频验证您的身份信息（比如护照、真人）',
        '1004_3' => '如何升级至1级？',
        '1004_3_1' => '您已在本平台完成注册',
        '1004_3_2' => '二、1级升级步骤如下：',
        '1004_3_3' => '登录系统，点“个人中心”菜单→“身份认证”→“升级至 1级”；',
        '1004_3_4' => '选择国籍；',
        '1004_3_5' => '填写个人基本信息，比如姓名、地址、邮编、手机号、出生地、出生日期；',
        '1004_3_6' => '确认基本信息无误，点“提交”；',
        '1004_3_7' => '系统将给您填写的手机号发送短信验证码，请填写设备收到的验证码，提交；',
        '1004_3_8' => '升级成功后，您可以发现“身份认证”页面的会员等级变成了1级。',
        '1004_3_9' => '重要事项提醒：',
        '1004_3_10' => '1.平台目前暂不支持以下国家的居民使用：美国、加拿大、圣文森特、格林那定群岛，涉及用户将无法升级。
<br />如果您没有收到短信，请检查：<br />①手机号是否填写正确？<br />②是否填写的是美国、加拿大、圣文森特、格林那定群岛的手机号？
<br />请务必保证手机号正确；由于政策原因，美国、加拿大、圣文森特、格林那定群岛的居民无法使用本平台。
<br />如果不是上述①和②的原因导致，请在“输入验证码”的页面点“取消”，然后点“升级至 1级”重新操作，如果还是升级失败，请联系我们的客服（这里填写客服邮箱）。',
        '1004_4' => '如何升级至2级？',
        '1004_4_1' => '您已升级至 1级。',
        '1004_4_2' => '升级之前，请提前准备好：',
        '1004_4_3' => '• 带摄像头的智能设备<br />• 设备上下载并安装IDnow（APP）<br />• 有效的护照或身份证',
        '1004_4_4' => '请点此查看<a href="/guide/#4-5" target="_blank" class="common-link color-blue">我们支持哪些护照和身份证？</a>',
        '1004_4_5' => '二、2级升级步骤如下：',
        '1004_4_6' => '1. 登录系统，点“个人中心”菜单→“身份认证”→“升级至 2级”；<br />2. 确认升1级时填写的个人基本信息，如需修改，请点“修改”；否则，确认信息无误后，点“提交”；
<br />3. 通过IDnow的视频通讯做身份验证；<br />4. 验证通过后，您可以发现“身份认证”页面的会员等级变成了2级。',
        '1004_4_7' => '关于IDnow的相关说明：',
        '1004_4_8' => '• 由于资源限制，您在申请视频验证的时候可能会需要排队，对于需要排队的情况，您可先暂停升级，我们将在IDnow可用的时候邮件提醒您继续。
<br />• IDnow拥有最严格的隐私保护标准，请放心使用。<br />• 在您完成了核对清单，浏览完条款后，将会有一个代表来带领您完成剩余的认证流程。
<br />• 只有在全部认证通过后，您的充值和提现额度才会真正提升。<br />• 整个流程大约需要几分钟。<br />• 如果认证失败，请联系我们的客服（这里是客服的联系邮箱）。',
        '1004_4_9' => '• 您在升2级时填写的个人基本信息在提交后将无法修改，请务必确认填写的信息与您做视频认证时的身份信息保持完全一致。',
        '1004_5' => '我们支持哪些护照和身份证？',
        '1004_5_1' => '对于通过视频验证升级至2级的，以下身份证件可能会用到。',
        '1004_5_2' => '平台支持的护照和身份证如下：',
        '1004_5_3' => '序号',
        '1004_5_4' => '国家',
        '1004_5_5' => '护照',
        '1004_5_6' => '身份证',
        '1004_6' => '我们不支持哪些居民使用？',
        '1004_6_1' => '由于政策原因，美国、加拿大、圣文森特、格林那定群岛的居民当前暂时无法使用本平台。',
        '1004_6_2' => '一旦这些国家的财政监管机构正式给出明确、正面的决定，我们将尽快放开这些限制，以便相关居民可以正常使用本平台。',
        '1005' => '安全',
        '1005_1' => '平台如何保障数字资产安全？',
        '1005_1_1' => '数字资产的安全存储和防护预案是我们平台建设的首要任务。',
        '1005_1_2' => '我们将数字资产根据用途和风险级别存储在不同地方，热钱包仅存储少量资产（主要用于实时兑付），绝大多数资产存储在冷钱包中（冷钱包不会与网络连接，彻底杜绝黑客入侵），同时使用多签名技术保障资产转出安全。',
        '1005_2' => '如何保障自己的账户安全？',
        '1005_2_1' => '针对用户账号，平台也提供了几个措施来保障您账号的安全：',
        '1005_2_2' => '• 密码保护：注册用户首先会有密码防护，这是账号的首层防护措施。
<br />• 2FA：我们强烈推荐用户激活2FA，这样，每次登录、提现都会增加一层验证码防护，提高了账号安全。
<br />• 邮件确认：对于重要的资产转出操作（如提现），除了2FA验证码，还需要用户至邮箱确认交易，保障交易的真实有效性。
<br />• 视频认证：我们对大额交易（充值、提现额度超过$ 1,000的交易）增加了限制，要求一定要经过视频认证通过后方可操作，视频认证一方面确认用户身份的真实性，另一方面确认用户开户是出自自己的真实意愿；从源头保护用户的真实权益。',
        '1006' => '常见问题',
        '1006_1_1' => '与充值、提现相关的常见问题及回复如下：',
        '1006_1_2' => '1.为什么我的交易一直显示“正在处理”？',
        '1006_1_3' => '可能有以下不同的理由：
<br />• 交易需要确认<br />提现的时候除了验证2FA，还需要到邮箱确认交易，这期间，交易的状态就是“正在处理”。
<br />• “热钱包”余额不足<br />有些交易延迟是因为“热钱包”余额不足，我们往里边充值后交易就可以正常进行。
<br />• 大额交易<br />通常，小额提现是非常快的，但是所有的大额提现交易都需要走人工操作（当我们发现账号在未知的设备、IP、国家登录时，也会走人工操作）。充值则很快就可以从账号中看到。',
        '1006_1_4' => '2.我要在哪里可以看到交易的状态？',
        '1006_1_5' => '历史交易记录都在菜单“交易记录”中，您可以登录系统，点“交易记录”菜单，即可查看全部交易情况。如果网站显示交易状态是“已完成”，就代表您的数字资产被发送到了指定的地址。
<br />备注：区块链上所有完成的交易都是最终的结果！如果您有任何问题，请马上联系我们：（这里是客服邮箱）。',
        '1006_1_6' => '3.我找不到充值的按钮怎么办？',
        '1006_1_7' => '请先登录，登录后即可展示“充值”菜单。<br />如果您想充值，那么您还需要将会员等级升至1级，1级及以上会员才具有充值额度，才能进行充值操作。',
        '1006_1_8' => '4.我没法从BitUP账户中提现怎么办？',
        '1006_1_9' => '如果您需要提现，那么您需要先激活2FA。激活2FA以后，您需要等待24小时才可开始“提现”操作。请点此查看 <a href="/guide/#1-2" target="_blank" class="common-link color-blue">如何激活2FA？</a>',
        '1006_1_10' => '5.我已经从BitUP账户中提现数字资产到其他钱包，但是我到现在在其他钱包仍然无法看到收到的数字资产，怎么办？',
        '1006_1_11' => '请先确认其他钱包是否支持你提现的数字资产。<br />另外，还有个比较普通的差错是，接收地址使用了其他数字资产的地址，比如，错误的将ETH提现到了BTC的充值地址，如果您发生了这种问题，建议您联系其他钱包的客服支持。<br />备注：区块链上所有完成的交易都是最终的结果，没有任何途径可以反方向操作！',
    )
);
$l = $_COOKIE['BT_LANG'];
$_Guide = $guide[$l];
$title = 'BitUP guide';
$country = array(
    array('cn' => '阿尔及利亚', 'en' => 'Algeria', 'passport' => true, 'ID'  => false),
    array('cn' => '阿根廷','en' => 'Argentina',  'passport' => true, 'ID'  => false),
    array('cn' => '爱尔兰','en' => 'Ireland',  'passport' => true, 'ID'  => true),
    array('cn' => '爱沙尼亚','en' => 'Estonia',  'passport' => true, 'ID'  => false),
    array('cn' => '奥地利','en' => 'Austria',  'passport' => true, 'ID'  => true),
    array('cn' => '巴西','en' => 'Brazil',  'passport' => true, 'ID'  => false),
    array('cn' => '保加利亚','en' => 'Bulgaria',  'passport' => true, 'ID'  => false),
    array('cn' => '比利时','en' => 'Belgium',  'passport' => true, 'ID'  => true),
    array('cn' => '冰岛','en' => 'Iceland',  'passport' => true, 'ID'  => false),
    array('cn' => '波兰','en' => 'Poland',  'passport' => true, 'ID'  => true),
    array('cn' => '波斯尼亚和黑塞哥维那','en' => 'Bosnia and Herzegovina',  'passport' => true, 'ID'  => false),
    array('cn' => '丹麦','en' => 'Denmark',  'passport' => true, 'ID'  => false),
    array('cn' => '德国','en' => 'Russia',  'passport' => true, 'ID'  => true),
    array('cn' => '俄罗斯','en' => 'Poland',  'passport' => true, 'ID'  => false),
    array('cn' => '法国','en' => 'France',  'passport' => true, 'ID'  => true),
    array('cn' => '芬兰','en' => 'Finland',  'passport' => true, 'ID'  => true),
    array('cn' => '哥伦比亚','en' => 'Colombia',  'passport' => true, 'ID'  => false),
    array('cn' => '韩国','en' => 'Korea',  'passport' => true, 'ID'  => false),
    array('cn' => '荷兰','en' => 'Netherlands',  'passport' => true, 'ID'  => true),
    array('cn' => '捷克共和国','en' => 'Czech Republic',  'passport' => true, 'ID'  => true),
    array('cn' => '克罗地亚','en' => 'Croatia',  'passport' => true, 'ID'  => true),
    array('cn' => '拉脱维亚','en' => 'Latvia',  'passport' => true, 'ID'  => true),
    array('cn' => '立陶宛','en' => 'Lithuania',  'passport' => true, 'ID'  => true),
    array('cn' => '列支敦士登','en' => 'Liechtenstein',  'passport' => true, 'ID'  => true),
    array('cn' => '卢森堡','en' => 'Luxembourg',  'passport' => true, 'ID'  => true),
    array('cn' => '罗马尼亚','en' => 'Romania',  'passport' => true, 'ID'  => false),
    array('cn' => '马耳他','en' => 'Malta',  'passport' => true, 'ID'  => true),
    array('cn' => '摩洛哥','en' => 'Morocco',  'passport' => true, 'ID'  => false),
    array('cn' => '墨西哥','en' => 'Mexico',  'passport' => true, 'ID'  => false),
    array('cn' => '南非','en' => 'South Africa',  'passport' => true, 'ID'  => false),
    array('cn' => '尼日利亚','en' => 'Nigeria',  'passport' => true, 'ID'  => false),
    array('cn' => '挪威','en' => 'Norway',  'passport' => true, 'ID'  => false),
    array('cn' => '葡萄牙','en' => 'Portugal',  'passport' => true, 'ID'  => true),
    array('cn' => '日本','en' => 'Japan',  'passport' => true, 'ID'  => false),
    array('cn' => '瑞典','en' => 'Sweden',  'passport' => true, 'ID'  => true),
    array('cn' => '瑞士','en' => 'Switzerland',  'passport' => true, 'ID'  => true),
    array('cn' => '塞浦路斯','en' => 'Cyprus',  'passport' => true, 'ID'  => false),
    array('cn' => '斯洛伐克','en' => 'Slovakia',  'passport' => true, 'ID'  => true),
    array('cn' => '斯洛文尼亚','en' => 'Slovenia',  'passport' => true, 'ID'  => true),
    array('cn' => '土耳其','en' => 'Turkey',  'passport' => true, 'ID'  => false),
    array('cn' => '乌克兰','en' => 'Ukraine',  'passport' => true, 'ID'  => false),
    array('cn' => '希腊','en' => 'Greece',  'passport' => true, 'ID'  => false),
    array('cn' => '西班牙','en' => 'Spain',  'passport' => true, 'ID'  => true),
    array('cn' => '新加坡','en' => 'Singapore',  'passport' => true, 'ID'  => false),
    array('cn' => '新西兰','en' => 'New Zealand',  'passport' => true, 'ID'  => false),
    array('cn' => '匈牙利','en' => 'Hungary',  'passport' => true, 'ID'  => true),
    array('cn' => '意大利','en' => 'Italy',  'passport' => true, 'ID'  => true),
    array('cn' => '英国','en' => 'England',  'passport' => true, 'ID'  => false),
    array('cn' => '中国/香港','en' => 'China/Hong Kong',  'passport' => true, 'ID'  => false)
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
<!--    <link rel="stylesheet" href="js/swiper.min.css">-->
</head>
<body>
<?php include_once '../common/tpl/header.php'; ?>

<div class="guide-main common-container">
    <div class="menu-slide-long swiper-container">
        <ul class="menu-slide swiper-wrapper">
            <li class="swiper-slide">
                <h3 class="title"><a href="#1"><i class="icon"></i><span><?php echo $_Guide['1001']; ?></span></a></h3>
                <div class="sub-menu">
                    <a href="#1-1"><i class="icon"></i><span><?php echo $_Guide['1001_1']; ?></span></a>
                    <a href="#1-2"><i class="icon"></i><span><?php echo $_Guide['1001_2']; ?></span></a>
                    <a href="#1-3"><i class="icon"></i><span><?php echo $_Guide['1001_3']; ?></span></a>
                </div>
            </li>
            <li class="swiper-slide">
                <h3 class="title"><i class="icon"></i><span><?php echo $_Guide['1002']; ?></span></h3>
                <div class="sub-menu">
                    <a href="#2-1"><i class="icon"></i><span><?php echo $_Guide['1002_1']; ?></span></a>
                    <a href="#2-2"><i class="icon"></i><span><?php echo $_Guide['1002_2']; ?></span></a>
                    <a href="#2-3"><i class="icon"></i><span><?php echo $_Guide['1002_3']; ?></span></a>
                    <a href="#2-4"><i class="icon"></i><span><?php echo $_Guide['1002_4']; ?></span></a>
                    <a href="#2-5"><i class="icon"></i><span><?php echo $_Guide['1002_5']; ?></span></a>
                </div>
            </li>
            <li class="swiper-slide">
                <h3 class="title"><i class="icon"></i><span><?php echo $_Guide['1003']; ?></span></h3>
                <div class="sub-menu">
                    <a href="#3-1"><i class="icon"></i><span><?php echo $_Guide['1003_1']; ?></span></a>
                    <a href="#3-2"><i class="icon"></i><span><?php echo $_Guide['1003_2']; ?></span></a>
                </div>
            </li>
            <li class="swiper-slide">
                <h3 class="title"><i class="icon"></i><span><?php echo $_Guide['1004']; ?></span></h3>
                <div class="sub-menu">
                    <a href="#4-1"><i class="icon"></i><span><?php echo $_Guide['1004_1']; ?></span></a>
                    <a href="#4-2"><i class="icon"></i><span><?php echo $_Guide['1004_2']; ?></span></a>
                    <a href="#4-3"><i class="icon"></i><span><?php echo $_Guide['1004_3']; ?></span></a>
                    <a href="#4-4"><i class="icon"></i><span><?php echo $_Guide['1004_4']; ?></span></a>
                    <a href="#4-5"><i class="icon"></i><span><?php echo $_Guide['1004_5']; ?></span></a>
                    <a href="#4-6"><i class="icon"></i><span><?php echo $_Guide['1004_6']; ?></span></a>
                </div>
            </li>
            <li class="swiper-slide">
                <h3 class="title"><i class="icon"></i><span><?php echo $_Guide['1005']; ?></span></h3>
                <div class="sub-menu">
                    <a href="#5-1"><i class="icon"></i><span><?php echo $_Guide['1005_1']; ?></span></a>
                    <a href="#5-2"><i class="icon"></i><span><?php echo $_Guide['1005_2']; ?></span></a>
                </div>
            </li>
            <li class="swiper-slide">
                <h3 class="title"><i class="icon"></i><span><?php echo $_Guide['1006']; ?></span></h3>
                <div class="sub-menu">
                    <a href="#6-1"><i class="icon"></i><span><?php echo $_Guide['1006']; ?></span></a>
                </div>
            </li>
        </ul>
    </div>
    <div class="content-panel" id="1-1">
        <h3 class="title"><?php echo $_Guide['1001_1']; ?></h3>
        <p><?php echo $_Guide['1001_1_1']; ?></p>
        <p><?php echo $_Guide['1001_1_2']; ?></p>
        <p><?php echo $_Guide['1001_1_3']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1001_1_4']; ?>  <?php echo $_Lang['100001']; ?></h4>
        <p><?php echo $_Guide['1001_1_5']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1001_1_6']; ?>  <?php echo $_Lang['100162']; ?></h4>
        <p><?php echo $_Guide['1001_1_7']; ?></p>
    </div>
    <div class="content-panel" id="1-2">
        <h3 class="title"><?php echo $_Guide['1001_2']; ?>？</h3>
        <h4 class="sub-title"><?php echo $_Guide['1001_2_1']; ?></h4>
        <p><?php echo $_Guide['1001_2_2']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1001_2_3']; ?></h4>
        <p><?php echo htmlspecialchars_decode($_Guide['1001_2_4']); ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1001_2_5']; ?></h4>
        <p><?php echo htmlspecialchars_decode($_Guide['1001_2_6']); ?></p>
    </div>
    <div class="content-panel" id="1-3">
        <h3 class="title"><?php echo $_Guide['1001_3']; ?>？</h3>
        <p><?php echo $_Guide['1001_3_1']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1001_3_2']; ?></h4>
        <p><?php echo $_Guide['1001_2_2']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1001_2_3']; ?></h4>
        <p><?php echo htmlspecialchars_decode($_Guide['1001_2_4']); ?><?php echo htmlspecialchars_decode($_Guide['1001_3_3']); ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1001_2_5']; ?></h4>
        <p><?php echo htmlspecialchars_decode($_Guide['1001_2_6']); ?></p>
    </div>
    <div class="content-panel" id="2-1">
        <h3 class="title">如何充值？</h3>
        <p>如果您需要充值，那么您需要先升级到1级，1级会员才能进行充值。</p>
        <p>备注：1级会员的充值限额是$1,000.00，2级会员充值无限额，我们推荐您升级至2级。</p>
        <p>
            充值步骤如下：<br />
            1. 登录系统，点“充值”菜单；<br />
            2. 选择需要将哪种数字资产充值进BitUP；<br />
            3. 此时页面将展示二维码和您在BitUP的接收地址，复制接收地址，并粘贴到您的数字资产钱包，完成转账即可。
        </p>
        <h4 class="sub-title">备注：</h4>
        <p>
            1. 您可随时检查本次交易的状态；<br />
            2. 充值交易全部是0费率，您可至<a href="/guide/#2-2" target="_blank" class="common-link color-blue">充值时间与费率</a>查看更详细的充值费率信息。
        </p>
        <p>请点此查看<a href="/guide/#4-3" target="_blank" class="common-link color-blue">如何升级至1级？</a></p>
        <p>请点此查看<a href="/guide/#4-4" target="_blank" class="common-link color-blue">如何升级至2级？</a></p>
    </div>
    <div class="content-panel" id="2-2">
        <h3 class="title">充值时间与费率？</h3>
        <p>所有的充值都是0费率，BitUP支持的各类数字资产，其充值执行时间分别如下：</p>
        <table class="common-table gd-table">
            <tr>
                <th>数字资产</th>
                <th>交易确认</th>
                <th>到账时间</th>
                <th>充值手续费</th>
            </tr>
            <tr>
                <td>比特币(永久)</td>
                <td>需要6次确认</td>
                <td>0～60分钟</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>以太坊(永久)</td>
                <td>需要12次确认</td>
                <td>0～3分钟</td>
                <td>0.00</td>
            </tr>
        </table>
    </div>
    <!--如何提现-->
    <div class="content-panel" id="2-3">
        <h3 class="title"><?php echo $_Guide['1002_3']; ?></h3>
        <h4 class="sub-title"><?php echo $_Guide['1002_3_1']; ?></h4>
        <p><?php echo $_Guide['1002_3_2']; ?><a href="/guide/#1-2" target="_blank" class="common-link color-blue"><?php echo $_Guide['1001_2']; ?></a>）</p>
        <h4 class="sub-title"><?php echo $_Lang['100163']; ?>：</h4>
        <p><?php echo $_Guide['1002_3_3']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1002_3_4']; ?></h4>
        <p><?php echo htmlspecialchars_decode($_Guide['1002_3_5']); ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1002_3_6']; ?></h4>
        <p>
            1.<?php echo htmlspecialchars_decode($_Guide['1002_3_7']); ?><br />
            2.<?php echo htmlspecialchars_decode($_Guide['1002_3_8']); ?><br />
            3.<?php echo htmlspecialchars_decode($_Guide['1002_3_9']); ?><br />
            4.<?php echo htmlspecialchars_decode($_Guide['1002_3_10']); ?><br />
            5.<?php echo htmlspecialchars_decode($_Guide['1002_3_11']); ?>
        </p>
    </div>
    <!--提现时间与费率-->
    <div class="content-panel" id="2-4">
        <h3 class="title"><?php echo $_Guide['1002_4']; ?></h3>
        <p><?php echo $_Guide['1002_4_1']; ?></p>
        <table class="common-table gd-table">
            <tr>
                <th><?php echo $_Guide['1002_4_2']; ?></th>
                <th><?php echo $_Guide['1002_4_3']; ?></th>
                <th><?php echo $_Guide['1002_4_4']; ?></th>
                <th><?php echo $_Guide['1002_4_5']; ?></th>
            </tr>
            <tr>
                <td><?php echo $_Lang['100164']; ?>（BTC）</td>
                <td><?php echo $_Guide['1002_4_6']; ?></td>
                <td><?php echo $_Guide['1002_4_8']; ?></td>
                <td>0.001 BTC /<?php echo $_Guide['1002_4_10']; ?></td>
            </tr>
            <tr>
                <td><?php echo $_Lang['100165']; ?>（ETH）</td>
                <td><?php echo $_Guide['1002_4_7']; ?></td>
                <td><?php echo $_Guide['1002_4_9']; ?></td>
                <td>0.005 ETH /<?php echo $_Guide['1002_4_10']; ?></td>
            </tr>
        </table>
    </div>
    <!--我们支持哪些数字资产-->
    <div class="content-panel" id="2-5">
        <h3 class="title"><?php echo $_Guide['1002_5']; ?></h3>
        <h4 class="sub-title"><?php echo $_Guide['1002_5_1']; ?></h4>
        <p>
            1.<?php echo $_Lang['100164']; ?>（BTC）<br />2.<?php echo $_Lang['100165']; ?>（ETH）
        </p>
        <h4 class="sub-title"><?php echo $_Guide['1002_3_6']; ?>：</h4>
        <p>
            1.<?php echo htmlspecialchars_decode($_Guide['1002_5_2']); ?><br />
            2.<?php echo htmlspecialchars_decode($_Guide['1002_3_8']); ?><br />
            3.<?php echo htmlspecialchars_decode($_Guide['1002_3_9']); ?><br />
            4.<?php echo htmlspecialchars_decode($_Guide['1002_3_10']); ?><br />
            5.<?php echo htmlspecialchars_decode($_Guide['1002_3_11']); ?>
        </p>
    </div>
    <!--如何买入数字资产组合-->
    <div class="content-panel" id="3-1">
        <h3 class="title"><?php echo $_Guide['1003_1']; ?></h3>
        <h4 class="sub-title"><?php echo $_Guide['1002_3_1']; ?></h4>
        <p><?php echo $_Guide['1003_1_1']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1003_1_2']; ?></h4>
        <p>
            1.<?php echo $_Guide['1003_1_3']; ?><br />2.<?php echo $_Guide['1003_1_4']; ?><br />
            3.<?php echo $_Guide['1003_1_5']; ?><br />4.<?php echo $_Guide['1003_1_6']; ?>
        </p>
        <h4 class="sub-title"><?php echo $_Guide['1003_1_7']; ?></h4>
        <p>
            1.<?php echo $_Guide['1003_1_8']; ?><br />2.<?php echo $_Guide['1003_1_9']; ?>
        </p>
        <h4 class="sub-title"><?php echo $_Guide['1003_1_10']; ?></h4>
        <p>
            1.<?php echo $_Guide['1003_1_11']; ?>0<br />2.<?php echo $_Guide['1003_1_12']; ?>0.5%/<?php echo $_Guide['1002_4_10']; ?><br />
            3.<?php echo $_Guide['1003_1_13']; ?><?php echo $_Guide['1003_1_14']; ?>
        </p>
        <h4 class="sub-title"><?php echo $_Guide['1001_2_5']; ?></h4>
        <p>1.<?php echo $_Guide['1003_1_15']; ?><br />2.<?php echo $_Guide['1003_1_16']; ?></p>
    </div>
    <!--如何卖出数字资产组合-->
    <div class="content-panel" id="3-2">
        <h3 class="title"><?php echo $_Guide['1003_2']; ?></h3>
        <h4 class="sub-title"><?php echo $_Guide['1002_3_1']; ?></h4>
        <p><?php echo $_Guide['1003_2_1']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1003_2_2']; ?></h4>
        <p>
            1.<?php echo $_Guide['1003_1_3']; ?><br />2.<?php echo $_Guide['1003_2_3']; ?><br />
            3.<?php echo $_Guide['1003_2_4']; ?><br />4.<?php echo $_Guide['1003_1_6']; ?>
        </p>
        <h4 class="sub-title"><?php echo $_Guide['1003_1_7']; ?></h4>
        <p>
            1.<?php echo $_Guide['1003_1_8']; ?><br />2.<?php echo $_Guide['1003_1_9']; ?>
        </p>
        <h4 class="sub-title"><?php echo $_Guide['1003_1_10']; ?></h4>
        <p>
            1.<?php echo $_Guide['1003_1_11']; ?>0<br />2.<?php echo $_Guide['1003_1_12']; ?>0.5%/<?php echo $_Guide['1002_4_10']; ?><br />
            3.<?php echo $_Guide['1003_1_13']; ?><?php echo $_Guide['1003_1_14']; ?>
        </p>
        <h4 class="sub-title"><?php echo $_Guide['1001_2_5']; ?></h4>
        <p>1.<?php echo $_Guide['1003_2_5']; ?><br />2.<?php echo $_Guide['1003_1_16']; ?></p>
    </div>
    <!--为什么我需要身份认证-->
    <div class="content-panel" id="4-1">
        <h3 class="title"><?php echo $_Guide['1004_1']; ?></h3>
        <p><?php echo $_Guide['1004_1_1']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1004_1_2']; ?></h4>
        <p>
            1.<?php echo $_Guide['1004_1_3']; ?><br />2.<?php echo $_Guide['1004_1_4']; ?>
        </p>
        <h4 class="sub-title"><?php echo $_Lang['100166']; ?>：</h4>
        <p>
            1.<?php echo $_Guide['1004_1_5']; ?><br />2.<?php echo $_Guide['1004_1_6']; ?>
        </p>
    </div>
    <!--会员等级和权益分别有哪些-->
    <div class="content-panel" id="4-2">
        <h3 class="title"><?php echo $_Guide['1004_2']; ?></h3>
        <p><?php echo $_Guide['1004_2_1']; ?></p>
        <table class="common-table gd-table">
            <tr>
                <th><?php echo $_Guide['1004_2_2']; ?></th>
                <th style="width: 220px;"><?php echo $_Guide['1004_2_3']; ?></th>
                <th style="width: 260px;"><?php echo $_Guide['1004_2_4']; ?></th>
            </tr>
            <tr>
                <td><?php echo $_Lang['100167']; ?></td>
                <td>
                    <?php echo $_Lang['100170']; ?>：$ 0.00<br />
                    <?php echo $_Lang['100162']; ?>：$ 0.00
                </td>
                <td><?php echo $_Guide['1004_2_5']; ?></td>
            </tr>
            <tr>
                <td><?php echo $_Lang['100168']; ?></td>
                <td>
                    <?php echo $_Lang['100170']; ?>（<?php echo $_Lang['100171']; ?>）：$ 1,000.00<br />
                    <?php echo $_Lang['100162']; ?>（<?php echo $_Lang['100171']; ?>）：$ 1,000.00
                </td>
                <td><?php echo $_Guide['1004_2_6']; ?></td>
            </tr>
            <tr>
                <td><?php echo $_Lang['100169']; ?></td>
                <td>
                    <?php echo $_Lang['100170']; ?>（<?php echo $_Lang['100171']; ?>）：（<?php echo $_Lang['100174']; ?>）<br />
                    <?php echo $_Lang['100162']; ?>（<?php echo $_Lang['100172']; ?>）：$ 50,000.00<br />
                    <?php echo $_Lang['100162']; ?>（<?php echo $_Lang['100173']; ?>）：$ 200,000.00
                </td>
                <td><?php echo $_Guide['1004_2_7']; ?></td>
            </tr>
        </table>
    </div>
    <!--如何升级至1级-->
    <div class="content-panel" id="4-3">
        <h3 class="title"><?php echo $_Guide['1004_3']; ?></h3>
        <h4 class="sub-title"><?php echo $_Guide['1002_3_1']; ?></h4>
        <p><?php echo $_Guide['1004_3_1']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1004_3_2']; ?></h4>
        <p>
            1.<?php echo $_Guide['1004_3_3']; ?><br />2.<?php echo $_Guide['1004_3_4']; ?><br />
            3.<?php echo $_Guide['1004_3_5']; ?><br />4.<?php echo $_Guide['1004_3_6']; ?><br />
            5.<?php echo $_Guide['1004_3_7']; ?><br />6.<?php echo $_Guide['1004_3_8']; ?>
        </p>
        <h4 class="sub-title"><?php echo $_Guide['1004_3_9']; ?></h4>
        <p><?php echo $_Guide['1004_3_10']; ?></p>
    </div>
    <!--如何升级至2级-->
    <div class="content-panel" id="4-4">
        <h3 class="title"><?php echo $_Guide['1004_4']; ?></h3>
        <h4 class="sub-title"><?php echo $_Guide['1002_3_1']; ?></h4>
        <p><?php echo $_Guide['1004_4_1']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1004_4_2']; ?></h4>
        <p><?php echo $_Guide['1004_4_3']; ?></p>
        <p><?php echo htmlspecialchars_decode($_Guide['1004_4_4']); ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1004_4_5']; ?></h4>
        <p><?php echo $_Guide['1004_4_6']; ?></p>
        <h4 class="sub-title"><?php echo $_Guide['1004_4_7']; ?></h4>
        <p><?php echo $_Guide['1004_4_8']; ?></p>
        <h4 class="sub-title"><?php echo $_Lang['100163']; ?></h4>
        <p><?php echo $_Guide['1004_4_9']; ?></p>
    </div>
    <!-- 我们支持哪些护照和身份证-->
    <div class="content-panel" id="4-5">
        <h3 class="title"><?php echo $_Guide['1004_5']; ?></h3>
        <p><?php echo $_Guide['1004_5_1']; ?></p>
        <p><?php echo $_Guide['1004_5_2']; ?></p>
        <table class="common-table gd-table">
            <tr>
                <th><?php echo $_Guide['1004_5_3']; ?></th>
                <th style="width: 160px;"><?php echo $_Guide['1004_5_4']; ?></th>
                <th><?php echo $_Guide['1004_5_5']; ?></th>
                <th><?php echo $_Guide['1004_5_6']; ?></th>
            </tr>
            <tbody>
            <?php foreach ($country as $key => $item){ ?>
                <tr>
                    <td>
                        <?php echo ($key + 1) ?>
                    </td>
                    <td>
                        <?php echo $item[$l] ?>
                    </td>
                    <td>
                        <?php
                            if ($item["passport"]==true) {
                                echo $_Lang["100175"];
                            }
                            else {
                                echo $_Lang["100176"];
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($item["ID"]==true) {
                            echo $_Lang["100175"];
                        }
                        else {
                            echo $_Lang["100176"];
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- 我们不支持哪些居民使用-->
    <div class="content-panel" id="4-6">
        <h3 class="title"><?php echo $_Guide['1004_6']; ?></h3>
        <p><?php echo $_Guide['1004_6_1']; ?></p>
        <p><?php echo $_Guide['1004_6_2']; ?></p>
    </div>
    <!-- 平台如何保障数字资产安全-->
    <div class="content-panel" id="5_1">
        <h3 class="title"><?php echo $_Guide['1005_1']; ?></h3>
        <p><?php echo $_Guide['1005_1_1']; ?></p>
        <p><?php echo $_Guide['1005_1_2']; ?></p>
    </div>
    <!-- 如何保障自己的账户安全 -->
    <div class="content-panel" id="5_2">
        <h3 class="title"><?php echo $_Guide['1005_2']; ?></h3>
        <p><?php echo $_Guide['1005_1_1']; ?></p>
        <h3 class="sub-title"><?php echo $_Guide['1005_2_1']; ?></h3>
        <p><?php echo $_Guide['1005_2_2']; ?></p>
    </div>
    <!-- 常见问题 -->
    <div class="content-panel" id="6-1">
        <h3 class="title"><?php echo $_Guide['1006']; ?></h3>
        <p><?php echo $_Guide['1006_1_1']; ?></p>
        <h3 class="sub-title"><?php echo $_Guide['1006_1_2']; ?></h3>
        <p><?php echo $_Guide['1006_1_3']; ?></p>
        <h3 class="sub-title"><?php echo $_Guide['1006_1_4']; ?></h3>
        <p><?php echo $_Guide['1006_1_5']; ?></p>
        <h3 class="sub-title"><?php echo $_Guide['1006_1_6']; ?></h3>
        <p><?php echo $_Guide['1006_1_7']; ?></p>
        <h3 class="sub-title"><?php echo $_Guide['1006_1_8']; ?></h3>
        <p><?php echo htmlspecialchars_decode($_Guide['1006_1_9']); ?></p>
        <h3 class="sub-title"><?php echo $_Guide['1006_1_10']; ?></h3>
        <p><?php echo $_Guide['1006_1_11']; ?></p>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>
<script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="guide.js"></script>
<script type="text/javascript" src="js/swiper.min.js"></script>
</body>
</html>