/**
 * Created by Hajay on 18/4/9.
 */

//通过set project.files对象指定需要编译的文件夹和引用的资源
// fis.set('project.files', ['bower_components/**', 'dashboard/**', 'pages/**', 'sdkv2/**', 'hajay/**']);
fis.set('project.files', ['app/**', 'pages/**', 'sdkv2/**', 'hajay/**', '.htaccess']);
// fis.set('project.files', ['bower_components/**', 'app/**', 'pages/**', 'sdkv2/**', 'hajay/**', '.htaccess']);
//fis.set('project.files', ['app/**', '.htaccess']);

//FIS modjs模块化方案，您也可以选择amd/commonjs等
fis.hook('module', {
    mode: 'mod'
});

//modules下面都是模块化资源
fis
    .match(/^\/app\/(.*)\.(js)$/i, {
        isMod: true,
        id: '$1' //id支持简写，去掉modules和.js后缀中间的部分
    })

    //为项目整洁外面的页面都放到pages下,pages下的页面发布时更换目录
    .match(/^\/pages\/(.*)$/i, {
        useCache: false,
        release: '$1'
    })
    //.match(/^\/bower_components\/(.*)$/i, {
    //    useCache: false,
    //    release: '/libs/$1'
    //})

    //.match(/^\/dashboard\/(index\.(php|html))$/i, {
    //    useCache: false,
    //    release: '$1'
    //})

    //一级同名组件，可以引用短路径，比如modules/jquery/juqery.js
    //直接引用为var $ = require('jquery');
    .match(/^\/app\/([^\/]+)\/\1\.(js)$/i, {
        id: '$1'
    })
    //.match(/^\/dashboard\/([^\/]+)\/\1\.(js)$/i, {
    //    id: '$1'
    //})
    //前端模板,当做类js文件处理，可以识别__inline, __uri等资源定位标识
    .match("**/*.tmpl", {
        isJsLike: true,
        release: false
    })
    //清除其他配置，只剩下如下配置
    //.match('*.{js,css,png,jpeg}', {
    //    useHash: true
    //})
    //页面模板不用编译缓存
    .match(/.*\.(html|jsp|tpl|vm|htm|asp|aspx|php)$/, {
        useCache: false
    });

/****************异构语言编译*****************/
//less的编译
//npm install [-g] fis-parser-less
fis.match('app/**/*.less', {
    rExt: '.css',
    parser: fis.plugin('less', {
        //fis-parser-less option
    })
});
fis.match('pages/**/*.less', {
    rExt: '.css',
    parser: fis.plugin('less', {
        //fis-parser-less option
    })
});

/**
 * 开发模式可以禁用 防止编译慢
 */
//-----start-----
//fis.match(/^\/(app)\/(.*\.js)$/i, {
//    // fis-optimizer-uglify-js 插件进行压缩，已内置
//    preprocessor: fis.plugin('annotate'),
//    optimizer: fis.plugin('uglify-js')
//});
//fis.match(/^(.*\.(less|css))$/, {
//    // fis-optimizer-clean-css 插件进行压缩，已内置
//    optimizer: fis.plugin('clean-css')
//});
//-----end-----

//打包与css sprite基础配置
fis.match('::packager', {
    // npm install [-g] fis3-postpackager-loader
    // 分析 __RESOURCE_MAP__ 结构，来解决资源加载问题
    postpackager: fis.plugin('loader', {
        resourceType: 'mod',
        useInlineMap: true // 资源映射表内嵌
    }),
    packager: fis.plugin('map'),
    //spriter: fis.plugin('csssprites', {
    //    layout: 'matrix',
    //    margin: '15'
    //})
});
//fis.match('dashboard/**/*.js', {
//    packTo: '/dashboard/test.js'
//});

//fis.media('qa').match('*', {
//    deploy: fis.plugin('http-push', {
//        receiver: '',
//        to: '' // 注意这个是指的是测试机器的路径，而非本地机器
//    })
//});
//
//fis.media('prod').match('**.js', {
//        preprocessor: fis.plugin('annotate'),
//        optimizer: fis.plugin('uglify-js')
//    }).match('**.css', {
//        optimizer: fis.plugin('clean-css')
//    });