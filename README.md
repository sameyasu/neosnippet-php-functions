# neosnippet-php-functions

neosnippetでphpの標準関数のスニペットを表示したいので突貫で作った。

vimが重くなるので、拡張機能の関数のほとんどは削っている。

## 使い方

1. プラグインマネージャーに追加する

```
call dein#add('sameyasu/neosnippet-php-functions')
```

2. `.vimrc`のsnippetのディレクトリ指定を追加する

```
let g:neosnippet#snippets_directory = [
  \ '~/.cache/dein/repos/github.com/Shougo/neosnippet-snippets/neosnippets',
  \ '~/.cache/dein/repos/github.com/sameyasu/neosnippet-php-functions/neosnippets',
  \ ]
```

末尾にこのリポジトリのsnippetファイルのディレクトリを追加する。
deinだとデフォルトで上記になると思う。

## カスタマイズ

`exclude_prefixes.txt`に除外する関数名(前方一致)を定義しているので、それを追加したり削除したりすればカスタマイズできる。

snipファイルを再生成するには、`php -f mksnippet.php > ./neosnippets/php.snip`を実行する。

## 参照元

[PHPのドキュメントダウンロード](http://php.net/download-docs.php)からSingle HTML　fileをダウンロードして、それを使って定義ファイルを作成した。

英語のドキュメントの方が正しそうだったので英語のドキュメントを使っている。
