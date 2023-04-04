

import java.util.*;

class Node{
    int data;
    Node next;

    Node(int data){
        this.data = data;
        this.next = null;        
    }
}

class test{

Node head = null,last,temp;


public void Create(){
    Scanner sc=new Scanner(System.in);
    System.out.println("Enter the number of nodes :");
    int n=sc.nextInt();
   
    System.out.println("Enter the data for first node :");
    int data=sc.nextInt();

    Node newNode = new Node(data);

    head = newNode;
    temp = head;

    for(int i=2;i<=n;i++){

        System.out.println("Enter the data for" + (i) + "node :");
        data=sc.nextInt();
        newNode = new Node(data);
        temp.next = newNode;
        temp = temp.next;
    
    }

}

public void add(int data){
    
    Node newNode = new Node(data);
    if(head == null){
        head = newNode;
    }
    else{
      temp = head;
      while(temp.next != null){
        temp = temp.next;
      }
      temp.next = newNode;
      temp = temp.next;
    }

}

public void AddAtFirst(int data){
    
    Node newNode = new Node(data);

    newNode.next = head;

    head = newNode;

}
public void display(){   
    
    temp = head;

        while(temp != null){
            System.out.print(temp.data);
            temp = temp.next;
        }

        
}

public void insertMiddle(){
    temp = head;
    Node prev = head;

    Node newNode = new Node(6);

    int n=5;

    while(temp!=null){

    if(temp.data == n){
        newNode.next = temp.next;
        temp.next = newNode;
        
        // prev.next = newNode;
        // newNode.next = temp.next;
        // temp

        break;

     }
    //  else{
    //     prev = temp;
    //  }
     temp = temp.next;
    }

}
public void deletelast(){
    
    temp = head;

    while(temp.next.next != null){
        temp=temp.next;
    }
    temp.next = null;
}

public static void main(String[] args) {

    test t=new test();
    t.Create();

    Scanner sc=new Scanner(System.in);
    // System.out.println("Enter the data node :");
    // int data=sc.nextInt();

    //t.add(data);
    //t.AddAtFirst(data);
 
    // t.deletelast();
    t.insertMiddle();

    t.display();

}
}