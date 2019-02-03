# neosnippet-php-functions

neosnippetでphpの標準関数のスニペットを表示したいので作りました。

## 使い方

1. プラグインマネージャーに追加する

```
call dein#add('sameyasu/neosnippet-php-functions')
```

2. `.vimrc`のsnippetのディレクトリ指定を追加する

```
let g:neosnippet#snippets_directory='~/.cache/dein/repos/github.com/Shougo/neosnippet-snippets/neosnippets,~/.cache/dein/repos/github.com/sameyasu/neosnippet-php-functions/neosnippets'
```

末尾に`,`をつけてこのリポジトリのsnippetファイルのディレクトリを追加する。
deinだとデフォルトで上記になると思う。

## 参照元

[PHPのドキュメントダウンロード](http://php.net/download-docs.php)からSingle HTML　fileをダウンロードして、それを使って定義ファイルを作成した。

英語のドキュメントの方が正しそうだったので英語のドキュメントを使っている。
