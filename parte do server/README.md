# Como receber notificações

1. Executar o comando no terminal:
```
$ sudo chmod +x telegram_bot.sh
```
2. Criar bot para obter o <b>ACCESS_TOKEN</b> e <b>CHAT_ID</b> do bot do telegram

* Usando botfather no Telegram, podemos criar um novo bot.
* Vá para o campo de pesquisa no Telegram e digite botfather.
* Vá para o campo da mensagem e clique em Iniciar.
![](https://www.assistanz.com/wp-content/uploads/2017/04/Telegram-1.png)

* Digite '/newbot' sem aspas no campo de mensagem e pressione enter
* Agora o pai do bot pede que você nomeie o novo bot. Dê qualquer nome de sua escolha. Neste exemplo, ele é nomeado como 'Jarvis'.

![](https://www.assistanz.com/wp-content/uploads/2017/04/Telegram-2.png)
* Bot requer um nome de usuário exclusivo. Digite um nome de usuário de sua escolha. Se já estiver em uso, tente outro.
* Depois que um nome de usuário for gerado com sucesso, você receberá uma mensagem de felicitações do botfather com o ID do token do bot. Esse ID de token é usado na API do Telegram para enviar mensagens.
![](https://www.assistanz.com/wp-content/uploads/2017/04/Telegram-3.png)
* Em seguida, precisamos obter o ID do bate-papo. Procure o bot recém-criado no campo de pesquisa e inicie uma sessão de bate-papo.
![](https://www.assistanz.com/wp-content/uploads/2017/04/Telegram-4.png)
* Para obter o ID do bate-papo, use o URL  https://api.telegram.org/bot$token/getupdates  (Substitua o $token pelo ID do token real obtido durante a criação do bot) no navegador que retorna com uma sequência de valores.
![](https://www.assistanz.com/wp-content/uploads/2017/04/Telegram-5.png)
* Na captura de tela, a seção destacada possui o ID do bate-papo.
* No caso de bate-papo em grupo, o bot precisa ser convidado para o grupo e, em seguida, executar a API getupdates para obter o ID do bate-papo. O ID do chat em grupo terá um sinal negativo no início.

* Para testar se o bot está funcionando, execute o URL  https://api.legram.org/bot$token/sendMessage?chat_id=$chatid&text=Hello+World  no navegador. (Substitua $token e $chatid pelos IDs correspondentes). A mensagem 'Hello World' será recebida no chat.
![](https://www.assistanz.com/wp-content/uploads/2017/04/Telegram-6.png)

* Se foi recebida a mensagem, agora edite o arquivo telegram_bot.sh e Substitua <token> e <chat_id> pelos IDs correspondentes e salve o arquivo.

![](https://i.ibb.co/cDVmDT5/Capturar.png)
