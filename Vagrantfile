# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "ubuntu/trusty64"

    config.vm.network :private_network, id: "proclaim_primary", ip: "192.168.10.250"
    config.vm.hostname = "proclaim"

    config.vm.provider :virtualbox do |vb|
      vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
      vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
      proclaim_pwd = Dir.pwd
      vb.name = File.basename(proclaim_pwd)
    end

    if defined?(VagrantPlugins::HostsUpdater)
      config.hostsupdater.aliases = ["local.proclaim.dev"]
      config.hostsupdater.remove_on_suspend = true
    end

    config.vm.synced_folder "config/", "/srv/config/", :mount_options => [ "dmode=777", "fmode=777" ]
    config.vm.synced_folder "database/", "/srv/database/", :mount_options => [ "dmode=777", "fmode=777" ]
    config.vm.synced_folder "provision/", "/srv/provision/", :mount_options => [ "dmode=777", "fmode=777" ]
    config.vm.synced_folder "www/", "/var/www/", :owner => "www-data", :mount_options => [ "dmode=775", "fmode=774" ]

    config.vm.provision :shell, path: "provision/provision.sh"

end