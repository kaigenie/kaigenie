<div class="login-container">
    <section id="login-content">
        <?php echo $this->Form->create('User'); ?>
        <h1>Login</h1>
        <div><?php echo $this->Form->input('username', array('placeholder' => 'Please input your username',
                                                             'label'=>false,
                                                             'id' => 'username',
                                                             'div' => false)
                                          ); ?></div>
        <div><?php echo $this->Form->input('password', array('placeholder' => 'Password',
                                                             'type'=>'password',
                                                             'label' => false,
                                                             'id' => 'password',
                                                             'div' => false)
                                            ); ?></div>
        <div>
            <input type="submit" value="Log in" />
            <?php echo $this->Html->link($title='Lost your password?', $url='/iforgot') ?>
            <?php echo $this->Html->link($title='Register', $url='/register') ?>
        </div>
        <?php echo $this->Form->end(); ?>

    </section><!-- content -->
</div><!-- container -->